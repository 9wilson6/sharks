<?php

namespace App\Http\Controllers;

use Auth;
use App\Bids;
use App\User;
use App\Orders;
use App\Refund;
use App\Subjects;
use App\Solutions;
use Carbon\Carbon;
use App\Notifications;
use App\StudentPayments;
use App\TutorWithdrawals;
use App\Mail\TutorRefund;
use App\Mail\StudentRefund;
use App\Mail\OrderCompleted;
use App\Events\BidsUpdated;
use Illuminate\Http\Request;
use App\Events\TutorBidsUpdated;
use App\Events\TutorOrdersUpdated;
use App\Events\StudentOrdersUpdated;
use Illuminate\Support\Facades\Mail;

class TutorOrdersController extends Controller
{
    public function index() {
        $activeorders = Orders::latest()->whereIn('status', array(1, 4, 5, 8))->where('tutor_id', Auth::user()->id)->paginate(20);
        $closedorders = Orders::latest()->whereIn('status', array(6, 7, 3))->where('tutor_id', Auth::user()->id)->paginate(20);
        return view('tutor.orders.index', compact('activeorders', 'closedorders'));
    }

    public function order($id) {
        $theorder = Orders::where('id', $id)->get();
        if ($theorder->isEmpty()) {
            abort(403, 'You are not allowed to view this page');
        }
        $order_id = Orders::with('bids', 'tutor', 'ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute', 'manualrelease')->where('id', $id)->first();
        if ($order_id->status != 1) {
            if ($order_id->tutor_id == Auth::user()->id) {
                return view('tutor.orderdetails.index', compact('order_id'));
            } else {
                abort(403, 'You are not allowed to view this page');
            }
        }
        return view('tutor.orderdetails.index', compact('order_id'));
    }

    public function find() {       
        $projects  = Orders::latest()->where('status', 1)->with('bids')->paginate(50);
        $subjects = Subjects::get();
        return view('tutor.orders.findprojects', compact('subjects', 'projects'));
    }

    private function calculatebidamount($budget){
        $faker = \Faker\Factory::create();
        switch ($budget) {
            case '$5-$10':
                $calculated_budget = $faker->randomFloat(2, 5, 10);
                break;
            case '$10-$30':
                $calculated_budget = $faker->randomFloat(2, 10, 30);
                break;
            case '$30-$100':
                $calculated_budget = $faker->randomFloat(2, 30, 100);
                break;
            case '$100-$250':
                $calculated_budget = $faker->randomFloat(2, 100, 250);
                break;
            case '$250-$500':
                $calculated_budget = $faker->randomFloat(2, 250, 500);
                break;
            case '$500-$1000':
                $calculated_budget = $faker->randomFloat(2, 500, 1000);
                break;
        }
        return $calculated_budget;
    }

    public function download($id, $file_name) {
      $file_path = storage_path('app/order/attachments/'.$id.'/'.$file_name);
      return response()->download($file_path);
    }

    public function add_solution($order_id) {
        return view('tutor.uploads.solution.index', compact('order_id'));
    }

    public function save_solution(Request $request, $id) {
        $rules = [];
        $customMessages = [];
        $files = $request->file('upload_file');
        if($request->hasFile('upload_file'))
        {
            $files = count($request->file('upload_file')) - 1;
            foreach(range(0, $files) as $index) {
                $rules['upload_file.' . $index] = 'required|mimes:log,doc,docx,ppt,pptx,zip,7z,rar,txt,pdf,xls,xlsx,jpg,jpeg,png|max:2048';
                $customMessages['upload_file.' . $index . '.required'] = 'File upload is required';
                $customMessages['upload_file.' . $index . '.mimes'] = 'The uploaded file must be a file of type: png, jpeg, jpg, gif, log, txt.';
            }
            $this->validate($request, $rules, $customMessages);

            $files = $request->file('upload_file');
            foreach ($files as $file) {
                $cleanedfilename = clean_filename($file->getClientOriginalName());
                $orderuploads = Solutions::create([
                    'order_id' => $id,
                    'tutor_id' => Auth::user()->id,
                    'original_filename' => $cleanedfilename,
                    'filename' => $cleanedfilename
                ]);            
                $file->storeAs('order/solutions/'.$id, $cleanedfilename);                
            }            
            $order = Orders::find($id);
            $order->update([
                'status' => 5,
                'date_completed' => date('Y-m-d H:i:s')
            ]);
            $orderdetails = Orders::where('id', $order->id)->with('tutor', 'student')->first();
            Mail::to($orderdetails->student->email)->send(new OrderCompleted($orderdetails));
            $notification = Notifications::create([
                'user_id' => Auth::user()->id,
                'description' => 'You uploaded a solution to order #'.$id,
            ]);
            $broadcastorderstudent = Orders::with('ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
            $broadcastorderstutor = Orders::with('bids', 'ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
            broadcast(new StudentOrdersUpdated($broadcastorderstudent))->toOthers();
            broadcast(new TutorOrdersUpdated($broadcastorderstutor))->toOthers();
            return redirect()->route('tutor.order', $id)->with('success', 'Order files were uploaded successfully');
        }
        return redirect()->route('tutor.order', $id)->with('error', 'You did not provide data');
    }

    public function download_solution($id, $file_name) {
      $file_path = storage_path('app/order/solutions/'.$id.'/'.$file_name);
      return response()->download($file_path);
    }

    public function download_revision($id, $file_name) {
      $file_path = storage_path('app/order/revisions/'.$id.'/'.$file_name);
      return response()->download($file_path);
    }

    public function refundorder($id) {
        //check if order exist
        $order = Orders::where('id', $id)->get();
        if ($order->isEmpty()) {
            return redirect()->back()->with('error', 'Order does not exist');
        }
        //check if the order has already been refunded
        $order = Orders::where('id', $id)->with('refund', 'tutor', 'student', 'studentwithdrawals')->first();
        //dd($order);
        if ($order->refund) {
            return redirect()->back()->with('error', 'This order has already been refunded');
        }    
        $notification = Notifications::create([
            'user_id' => $order->tutor->id,
            'description' => 'You have refunded order #'.$id,
        ]);
        //Store the refund details
        $refund = Refund::create([
            'order_id' => $id,
            'description' => 'Tutor refund for order #'.$id,
            'refund_agent' => Auth::user()->name,
            'refund_agent_id' => Auth::user()->id
        ]);
        //Add student payment from refund to database
        foreach ($order->studentwithdrawals as $withdrawal) {
            $studentpayment = StudentPayments::create([
                'student_id' => $order->student->id,
                'amount' => $withdrawal->amount,
                'description' => 'Refund from tutor '.$order->tutor->name.' for order #'.$id,
                'payment_method' => 'refund',
                'transaction_id' => 'REFUND-'.$id
            ]);
        }
        //change order status
        $order = Orders::find($id);        
        $order->update([
            'status' => 6,
        ]);

        if ($studentpayment) {
           Mail::to($order->student->email)->send(new StudentRefund($id));
           Mail::to($order->tutor->email)->send(new TutorRefund($id));
        }
        
        $broadcastorderstudent = Orders::with('ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
        $broadcastorderstutor = Orders::with('bids', 'ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
        broadcast(new StudentOrdersUpdated($broadcastorderstudent))->toOthers();
        broadcast(new TutorOrdersUpdated($broadcastorderstutor))->toOthers();
        return redirect()->route('tutor.order', $id)->with('status', 'Your refund was successful');           
    }

    public function ratestudent($orderid) {
        $orderdetails = Orders::where('id', $orderid)->with('student')->first();
        return view('tutor.ratings.index', compact('orderdetails'));
    }

    public function save_student_ratings(Request $request, $orderid) {
        $orderdetails = Orders::where('id', $orderid)->with('student')->first();
        $thestudent = User::where('id', $orderdetails->student->id)->first();
        $rating = new \muyaedward\Rateable\Rating;
        $rating->rating = request('rating');
        $rating->comments = request('comments');
        $rating->recommend = request('recommend');
        $rating->user_id = Auth::user()->id;
        $rating->order_id = $orderid;
        $thestudent->ratings()->save($rating);
        $broadcastorderstudent = Orders::with('ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $orderid)->first();
        $broadcastorderstutor = Orders::with('bids', 'ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $orderid)->first();
        broadcast(new StudentOrdersUpdated($broadcastorderstudent))->toOthers();
        broadcast(new TutorOrdersUpdated($broadcastorderstutor))->toOthers();
        return redirect()->route('tutor.order', $orderid)->with('status', 'Thank you for your review');
    }
}