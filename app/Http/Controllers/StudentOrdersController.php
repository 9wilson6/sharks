<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Orders;
use App\Revisions;
use Carbon\Carbon;
use App\DisputeOrders;
use App\Notifications;
use App\Mail\DisputeOrder;
use Illuminate\Http\Request;
use App\Mail\WithdrawDispute;
use App\Mail\RequestRevision;
use App\Mail\AdminDisputeOrder;
use App\Mail\DisputeOrderstudent;
use App\Events\TutorOrdersUpdated;
use App\Events\StudentOrdersUpdated;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestRevisionstudent;

class StudentOrdersController extends Controller
{
    public function index() {
        $activeorders = Orders::latest()->whereIn('status', array(1, 4, 5, 8))->where('student_id', Auth::user()->id)->paginate(20);
        $closedorders = Orders::latest()->whereIn('status', array(6, 7, 3))->where('student_id', Auth::user()->id)->paginate(20);
        return view('student.orders.index', compact('activeorders', 'closedorders'));
    }

    public function order($id) {
        $theorder = Orders::where('id', $id)->get();
        if ($theorder->isEmpty()) {
            abort(403, 'You are not allowed to view this page');
        }
        $order_id = Orders::with('ratings', 'tutor', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
        if ($order_id->student_id == Auth::user()->id) {
            return view('student.orderdetails.index', compact('order_id'));
        } else {
            abort(403, 'You are not allowed to view this page');
        }
    }

    public function extend(Request $request, $id) {
        $orders = Orders::where('id', $id)->get();
        if ($orders->isEmpty()) {
            return response()->json([
                'error' => 'That order does not exists'
            ], 401);
        }
        $orders = Orders::where('id', $id)->first();
        $date = Carbon::parse($orders->homedata)->addDays(request('days'))->addHours(request('hours'));
        $order = Orders::findOrfail($id);
        $order->update([
            'homedate' => $date
        ]);

        if ($order) {
            return redirect()->route('home.order', $id)->with('status', 'Deadline was extended successfully');
        }
    }

    public function edit($id) {
        $order = Orders::where('id', $id)->first();
        return view('student.orders.edit', compact('order'));
    }

    public function update(Request $request, $id) {
        $order = Orders::find($id);
        $order->update([
            'subject' => request('subject'),
            'title' => request('title'),
            'homedate' => request('homedate'),
            'description' => request('description')
        ]);
        $broadcastorderstudent = Orders::with('ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
        $broadcastorderstutor = Orders::with('bids', 'ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
        broadcast(new StudentOrdersUpdated($broadcastorderstudent))->toOthers();
        broadcast(new TutorOrdersUpdated($broadcastorderstutor))->toOthers();
        return redirect()->route('student.order.details', $id)->with('status', 'Order was successfully updated');
    }

    public function deleteorder($id) {
        $order = Orders::where('id', $id)->first();
        if ($order->status != 1) {
            return redirect()->route('student.order.details', $id)->with('error', 'You can not delete this order yet. Contact admin');
        }
        $orderdelete = Orders::find($id);
        $orderdelete->delete();
        $broadcastorderstudent = Orders::with('ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
        $broadcastorderstutor = Orders::with('bids', 'ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
        broadcast(new StudentOrdersUpdated($broadcastorderstudent))->toOthers();
        broadcast(new TutorOrdersUpdated($broadcastorderstutor))->toOthers();
        return redirect()->route('studenthome')->with('status', 'Order was deleted successfully');
    }

    public function dispute_order($id) {
        return view('student.orders.dispute', compact('id'));
    }

    public function save_dispute(Request $request, $id) {
        $orderdetails = Orders::where('id', $id)->with('tutor', 'student')->first();
        $dispute = DisputeOrders::create([
            'order_id' => $id,
            'tutor_id' => $orderdetails->tutor->id,
            'reason' => request('reason')
        ]);        
        $order = Orders::find($id);
        $order->update([
            'status' => 3,
        ]);
        $notification = Notifications::create([
            'user_id' => $orderdetails->tutor->id,
            'description' => 'Student disputed order #'.$id,
        ]);
        //get admin user
        $adminuser = User::where('id', 1)->first();
        Mail::to($orderdetails->student->email)->send(new DisputeOrderstudent($orderdetails));
        Mail::to($orderdetails->tutor->email)->send(new  DisputeOrder($dispute, $orderdetails));
        Mail::to($adminuser->email)->send(new  AdminDisputeOrder($dispute, $orderdetails));
        $broadcastorderstudent = Orders::with('ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
        $broadcastorderstutor = Orders::with('bids', 'ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
        broadcast(new StudentOrdersUpdated($broadcastorderstudent))->toOthers();
        broadcast(new TutorOrdersUpdated($broadcastorderstutor))->toOthers();
        return redirect()->route('student.order.details', $id)->with('status', 'You have disputed this order, you have 24 hours to withdraw');
    }

    public function dispute_withdraw($id) {
        $orderdetails = Orders::where('id', $id)->with('tutor', 'student')->first();
        DisputeOrders::where('order_id', $id)->delete();
        $order = Orders::find($id);
        $order->update([
            'status' => 5,
        ]);
        $notification = Notifications::create([
            'user_id' => $orderdetails->tutor->id,
            'description' => 'Student has withdrawn dispute for order #'.$id,
        ]);
        Mail::to($orderdetails->tutor->email)->send(new WithdrawDispute($id));
        $broadcastorderstudent = Orders::with('ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
        $broadcastorderstutor = Orders::with('bids', 'ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
        broadcast(new StudentOrdersUpdated($broadcastorderstudent))->toOthers();
        broadcast(new TutorOrdersUpdated($broadcastorderstutor))->toOthers();
        return redirect()->route('student.order.details', $id)->with('status', 'Dispute withdrawn');
    }

    public function revision_order($id) {
        return view('student.orders.revision', compact('id'));
    }

    public function save_revision(Request $request, $id) {
        $orderdetails = Orders::where('id', $id)->with('tutor', 'student')->first();
        $file = $request->file('upload_file');
        if($request->hasFile('upload_file')) {
            $cleanedfilename = clean_filename($file->getClientOriginalName());
            $revision = Revisions::create([
                'order_id' => $id,
                'provision' => request('provision'),
                'instruction' => request('instruction'),
                'upload' => $cleanedfilename
            ]);
            $file->storeAs('order/revisions/'.$id, $cleanedfilename);
        }else {
            $revision = Revisions::create([
                'order_id' => $id,
                'provision' => request('provision'),
                'instruction' => request('instruction'),
                'upload' => 'noattachement'
            ]);
        }
        $order = Orders::find($id);
        $order->update([
            'status' => 8,
        ]);
        $notification = Notifications::create([
            'user_id' => $orderdetails->tutor->id,
            'description' => 'Student has requested revision for order #'.$id,
        ]);
        Mail::to($orderdetails->student->email)->send(new RequestRevisionstudent($revision));
        Mail::to($orderdetails->tutor->email)->send(new RequestRevision($revision));
        $broadcastorderstudent = Orders::with('ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
        $broadcastorderstutor = Orders::with('bids', 'ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
        broadcast(new StudentOrdersUpdated($broadcastorderstudent))->toOthers();
        broadcast(new TutorOrdersUpdated($broadcastorderstutor))->toOthers();
        return redirect()->route('student.order.details', $id)->with('status', 'Your request for revision has been sent');        
    }

    public function download_revision($id, $file_name) {
      $file_path = storage_path('app/order/revisions/'.$id.'/'.$file_name);
      return response()->download($file_path);
    }

    public function ratetutor($orderid) {
        $orderdetails = Orders::where('id', $orderid)->with('tutor')->first();
        return view('student.ratings.index', compact('orderdetails'));
    }

    public function save_tutor_ratings(Request $request, $orderid) {
        $orderdetails = Orders::where('id', $orderid)->with('tutor')->first();
        $thetutor = User::where('id', $orderdetails->tutor->id)->first();
        $rating = new \muyaedward\Rateable\Rating;
        $rating->rating = request('rating');
        $rating->comments = request('comments');
        $rating->recommend = request('recommend');
        $rating->user_id = Auth::user()->id;
        $rating->order_id = $orderid;
        $thetutor->ratings()->save($rating);
        $broadcastorderstudent = Orders::with('ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $orderid)->first();
        $broadcastorderstutor = Orders::with('bids', 'ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $orderid)->first();
        broadcast(new StudentOrdersUpdated($broadcastorderstudent))->toOthers();
        broadcast(new TutorOrdersUpdated($broadcastorderstutor))->toOthers();
        return redirect()->route('student.order.details', $orderid)->with('status', 'Thank you for your review');
    }
}