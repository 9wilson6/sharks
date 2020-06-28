<?php

namespace App\Http\Controllers;
//use Request;
use Illuminate\Http\Request;
use View;
use PayPal\Rest\ApiContext;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;
use App\Orders;
use App\Subjects;
use App\OrderAttachments;
use App\Solutions;
use App\Bids;
use App\DisputeOrders;
use App\Revisions;
use App\Refunds;
use App\Paypal;
use App\Notifications;
use File;
use Carbon\Carbon;
use Session;
use Validator;
use Paypalpayment;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\OrderPayments;
use App\Payments;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
//emails  StudentRefund
use App\Mail\RequestRevision;
use App\Mail\RequestRevisionstudent;
use App\Mail\DisputeOrder;
use App\Mail\WithdrawDispute;
use App\Mail\ReleasePayment;
use App\Mail\ThankforPayment;
use App\Mail\OrderCompleted;
use App\Mail\DisputeOrderstudent;
use App\Mail\Orderawarded;
use App\Mail\TutorBid;

use App\Mail\StudentRefund;
use App\Mail\TutorRefund;

use Srmklive\PayPal\Services\ExpressCheckout;

class OrdersController extends Controller
{
    private $_api_context;

    public function __construct()
    {
        // setup PayPal api context
        $paypal_conf = config('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == 'tutor') {
        $activeorders = Orders::latest()->whereIn('status', array(4, 5, 8))->where('awarded_to', Auth::user()->id)->paginate(20);
        $closedorders = Orders::latest()->whereIn('status', array(6, 7, 3))->where('awarded_to', Auth::user()->id)->paginate(20);
        return view('account.orders.orders', compact('activeorders', 'closedorders'));
        } elseif(Auth::user()->role == 'student') {
        $activeorders = Orders::latest()->whereIn('status', array(1, 4, 5, 8))->where('student_id', Auth::user()->id)->paginate(20);
        $closedorders = Orders::latest()->whereIn('status', array(6, 7, 3))->where('student_id', Auth::user()->id)->paginate(20);
        return view('account.orders.orders', compact('activeorders', 'closedorders'));
        }
    }

    public function request_revision($id)
    {
        $order_id = Orders::where('id', $id)->first();
        return view('account.orders.request_revision', compact('order_id'));
    }

    public function refund_order($id)
    {
        $order_id = Orders::where('id', $id)->first();
        return view('account.orders.refund', compact('order_id'));
    }

    public function dispute_order($id)
    {
        $order_id = Orders::where('id', $id)->first();
        return view('account.orders.dispute_order', compact('order_id'));
    }

    public function refundorder(Request $request)
    {
        if (Auth::user()->role == 'tutor') {
            $orderdetails = Orders::where('id', request('order_id'))->first();
            $tutordetails = User::where('id', $orderdetails->awarded_to)->first();
            $studentdetails = User::where('id', $orderdetails->student_id)->first();
            $refund = Refunds::create([
                'order_id' => request('order_id'),
                'reason' => request('reason')
            ]);
            $notification = Notifications::create([
                'user_id' => $tutordetails->id,
                'description' => 'You have refunded order #'.request('order_id'),
            ]);
            $order = Orders::find(request('order_id'));
            $order->update([
            /*'status' => 2,*/
            'status' => 6,
            ]);
            Mail::to($studentdetails->email)->send(new StudentRefund($refund));
            Mail::to($tutordetails->email)->send(new TutorRefund($refund));
            return redirect('/account/scholarview/'.request('order_id'))->with('status', 'Your refund was successiful');

        } else {
            return redirect('/account/forbidden/');
        }
    }

    public function requestrevision(Request $request)
    {
        if (Auth::user()->role == 'student') {
            $orderdetails = Orders::where('id', request('order_id'))->first();
            $userdetails = User::where('id', $orderdetails->awarded_to)->first();

            $student = User::where('id', $orderdetails->student_id)->first();

            if (!empty($request->file('upload'))) {
                $file = $request->file('upload');
                $file_name = $file->getClientOriginalName();
                $file->storeAs('revision/'.request('order_id'), $file_name);
                $upload = $file_name;
            } else {
                $upload = 'noattachement';
            }
            $revision = Revisions::create([
                'order_id' => request('order_id'),
                'provision' => request('provision'),
                'instruction' => request('instruction'),
                'upload'      => $upload,
            ]);
            $order = Orders::find(request('order_id'));
            $order->update([
            'status' => 8,
            ]);
            $notification = Notifications::create([
                'user_id' => $userdetails->id,
                'description' => 'Student has requested revision for order #'.request('order_id'),
            ]);
            Mail::to($student->email)->send(new RequestRevisionstudent($revision));
            Mail::to($userdetails->email)->send(new RequestRevision($revision));
            return redirect('/account/studentview/'.request('order_id'))->with('status', 'Your request for revision has been sent');
        } else {
            return redirect('/account/forbidden/');
        }
    }

    public function getrevision_upload($filename, $order_id){

        $tempImage = tempnam(sys_get_temp_dir(), $filename);
        copy(Storage::temporaryUrl('revision/'.$order_id.'/'.$filename, now()->addMinutes(5)), $tempImage);
        return response()->download($tempImage, $filename);
    }

    public function disputeorder(Request $request)
    {
        if (Auth::user()->role == 'student') {
            $orderdetails = Orders::where('id', request('order_id'))->first();
            $userdetails = User::where('id', $orderdetails->awarded_to)->first();
            $studee = User::where('id', $orderdetails->student_id)->first();
            $disputeord = DisputeOrders::create([
                'order_id' => request('order_id'),
                'name' => $userdetails['name'],
                'title' => $orderdetails->title,
                'reason' => request('reason')
            ]);
            $dispute = [
                'name' => $userdetails['name'],
                'order_id' => request('order_id'),
                'student' => $studee['name'],
                'title' => $orderdetails['title'],
                'reason' => request('reason')
            ];
            $order = Orders::find(request('order_id'));
            $order->update([
            'status' => 3,
            ]);
            $notification = Notifications::create([
                'user_id' => $userdetails->id,
                'description' => 'Student disputed order #'.request('order_id'),
            ]);
            Mail::to($userdetails['email'])->send(new DisputeOrder($dispute));
            Mail::to(Auth::user()->email)->send(new DisputeOrderstudent($dispute));
            return redirect('/account/studentview/'.request('order_id'))->with('status', 'You have disputed this order, you have 24 hours to withdraw');
        } else {
            return redirect('/account/forbidden/');
        }
    }

    public function withdrawdispute($id)
    {
        /*http://stackoverflow.com/questions/42792654/how-to-check-if-time-is-greater-than-created-at-in-database-with-carbon-laravel*/
        $orderdetails = Orders::where('id', $id)->first();
        $userdetails = User::where('id', $orderdetails->awarded_to)->first();

        $deleted = DB::table('dispute_orders')->where('order_id', $id)->delete();
        $order = Orders::find($id);
        $order->update([
        'status' => 5,
        ]);
        $notification = Notifications::create([
            'user_id' => $userdetails->id,
            'description' => 'Student has withdrawn dispute for order #'.$id,
        ]);
        $dispute = array('id'=>$id);
        Mail::to($userdetails['email'])->send(new WithdrawDispute($dispute));

        return redirect('/account/studentview/'.$id)->with('status', 'Dispute withdrawn');
    }

    public function release_payment($id)
    {
        $orderdetailss = Orders::where('id', $id)->first();
        $tutordetails = User::where('id', $orderdetailss->awarded_to)->first();
        $studentdetails = User::where('id', $orderdetailss->student_id)->first();
        $order = Orders::find($id);
        $order->update([
        'status' => 6,
        ]);
        $orderdetails = Orders::where('id', $id)->first();
        $opayment = OrderPayments::create([
            'paid_from' => $orderdetails->student_id,
            'paid_to' => $orderdetails->awarded_to,
            'description' => 'Payment for order #'.$orderdetails->id,
            'order_no' => $orderdetails->id,
            'amount' => $order->agreed_amount,
            'order_amount' => $order->agreed_amount
        ]);
        //Determined by level
        $amount = 0.43 * $order->agreed_amount;
        $fee = 0.57 * $order->agreed_amount;
        $orderpayment = Payments::create([
            'paid_from' => $orderdetails->student_id,
            'paid_to' => $orderdetails->awarded_to,
            'description' => 'Payment for order #'.$orderdetails->id,
            'amount' => $amount,
            'order_no' => $orderdetails->id,
            'fee' => $fee,
            'order_amount' => $order->agreed_amount
        ]);

        $prelease = [
           'tutor' => $tutordetails['name'],
           'student' => $studentdetails['name'],
           'order' => $orderdetails->id
        ];
        $notification = Notifications::create([
            'user_id' => $tutordetails->id,
            'description' => 'Student has released payment for order #'.$id,
        ]);
        Mail::to($tutordetails['email'])->send(new ReleasePayment($prelease));
        //Mail::to($studentdetails['email'])->send(new ThankforRelease($opayment));
        return redirect('/account/studentview/'.$id)->with('status', 'You have released payment to tutor');
    }

    public function upload_file(Request $request)
    {
        $orderdetails = Orders::where('id', request('order_id'))->first();
        $studentdetails = User::where('id', $orderdetails->student_id)->first();
            $user = Auth::user();
            $order_id = request('order_id');
            $files = $request->file('upload_file');
            if (is_array($files) || is_object($files))
            foreach($files as $file) {
               $ext = $file->guessClientExtension();
               $fname = $file->getClientOriginalName();
               $gfilename = $fname;
               $file->storeAs('orderattachment/'.$order_id, $gfilename);
               $solution = OrderAttachments::create([
                'order_id' => $order_id,
                'student_id' => $studentdetails->id,
                'original_filename' => $fname.'.'.$ext,
                'filename' => $gfilename,
               ]);
            }
            return redirect('/account/studentview/'.$order_id)->with('status', 'You have added attachments');
    }
    public function uploadsolution($id)
    {
        $order_id = $id;
        return view('account.orders.upload_solution', compact('order_id'));
    }

    public function add() {
        $file = Request::file('filefield');
        return redirect('fileentry');
    }

    public function upload_solution(Request $request)
    {
        $orderdetails = Orders::where('id', request('order_id'))->first();
        $tutordetails = User::where('id', $orderdetails->awarded_to)->first();
        $studentdetails = User::where('id', $orderdetails->student_id)->first();
        $user = Auth::user()->id;
        $order_id = request('order_id');
        $files = $request->file('upload_file');
        if (is_array($files) || is_object($files))
        {
            foreach($files as $file) {
               $ext = $file->guessClientExtension();
               $fname = $file->getClientOriginalName();
               $gfilename = $fname;
               $file->storeAs('solution/'.$order_id, $gfilename);
               $solution = Solutions::create([
                'order_id' => $order_id,
                'student_id' => $studentdetails->id,
                'tutor_id' => $tutordetails->id,
                'original_filename' => $fname.'.'.$ext,
                'filename' => $gfilename,
               ]);
            }
        }
        $order = Orders::find($order_id);
        $order->update([
        'status' => 5,
        'date_completed' => date('Y-m-d H:i:s')
        ]);
        $completed = [
            'title' => $orderdetails->title,
            'tutorname' => $tutordetails->name,
            'studentname' => $studentdetails->name,
            'order' => $order_id
        ];
        Mail::to($studentdetails['email'])->send(new OrderCompleted($completed));
        $notification = Notifications::create([
            'user_id' => $tutordetails->id,
            'description' => 'You uploaded a solution to order #'.$order_id,
        ]);
        return redirect('/account/scholarview/'.$order_id)->with('status', 'Your solution was uploaded successfully');
    }

    public function getsolution($filename, $id){
        $tempImage = tempnam(sys_get_temp_dir(), $filename);
        copy(Storage::temporaryUrl('solution/'.$id.'/'.$filename, now()->addMinutes(5)), $tempImage);
        return response()->download($tempImage, $filename);
    }

    public function getattach($filename, $id){
        $tempImage = tempnam(sys_get_temp_dir(), $filename);
        copy(Storage::temporaryUrl('orderattachment/'.$id.'/'.$filename, now()->addMinutes(5)), $tempImage);
        return response()->download($tempImage, $filename);
    }

    public function scholarview(Orders $order_id)
    {
        $studentrated = DB::table('ratings')->where('user_id', $order_id->student_id)->where('order_id', $order_id->id)->count();
        $tutorrated = DB::table('ratings')->where('user_id', $order_id->student_id)->where('order_id', $order_id->id)->count();
        $userid = Auth::user()->id;
        $solutions = Solutions::where('order_id', $order_id->id)->get();
        $attachments = OrderAttachments::where('order_id', $order_id->id)->get();
        $bids = Bids::latest()->where('order_id', $order_id->id)->get();
        if (Bids::where('tutor_id', $userid)->where('order_id', $order_id->id)->count() > 0) {
           $havebid = true;
        }else{
           $havebid = false;
        }
        $bids_rating = Bids::where('order_id', $order_id->id)->first();
        $disputes = DisputeOrders::where('order_id', $order_id->id)->first();
        $dt = Carbon::parse($disputes['created_at']);
        $subscription = $dt->addHours(24);
        $remaining = $subscription->diffForHumans();
        $revisions = Revisions::latest()->where('order_id', $order_id->id)->get();

        //Conditions
        $seeorder = true;
        //Condition number 1

        if ($order_id->status == 1) {
            $seeorder = true;
        } else {
            if ($order_id->tutor_id != $userid) {
                $seeorder = false;
            }
        }

        if ($seeorder) {
            return view('account.orders.scholarview', compact('order_id', 'bids', 'havebid', 'bids_rating', 'attachments', 'studentrated', 'tutorrated', 'solutions', 'disputes', 'remaining', 'revisions'));
        } else {
            return view('account.notauthorized');
        }
    }

    function allstudentbids($id, $rating) {
        $rated = Orders::first()->userRatingCount($rating);
        $bids = Bids::latest()->where('order_id', $id)->get();
        $view = View::make('account.orders.allstudentbids', compact('bids', 'rated'));
        $sections = $view->renderSections()['content'];
        if(request()->ajax()) {
            $view = View::make('account.orders.allstudentbids', compact('bids', 'rated'));
            $sections = $view->renderSections()['content'];
            echo $sections;
        }
    }

    function alltutorbids($id, $rating) {
        $rated = Orders::first()->userRatingCount($rating);
        $bids = Bids::latest()->where('order_id', $id)->get();
        $view = View::make('account.orders.alltutorbids', compact('bids', 'rated'));
        $sections = $view->renderSections()['content'];
        if(request()->ajax()) {
            $view = View::make('account.orders.alltutorbids', compact('bids', 'rated'));
            $sections = $view->renderSections()['content'];
            echo $sections;
        }
    }



    function studentactions(Orders $order_id) {
        $isdisputed = DisputeOrders::where('order_id', $order_id->id)->count();
        $tutorrated = DB::table('ratings')->where('user_id', $order_id->awarded_to)->where('order_id', $order_id->id)->count();
        if(request()->ajax()) {
            $view = View::make('account.orders.studentactions', compact('order_id', 'isdisputed', 'tutorrated'));
            $sections = $view->renderSections()['content'];
            return $sections;
        }
    }

    function tutoractions(Orders $order_id) {
        $studentrated = DB::table('ratings')->where('user_id', $order_id->student_id)->where('order_id', $order_id->id)->count();
        if(request()->ajax()) {
            $view = View::make('account.orders.tutoractions', compact('order_id', 'tutorrated', 'studentrated'));
            $sections = $view->renderSections()['content'];
            return $sections;
        }
    }


    public function studentview(Orders $order_id)
    {
        $isdisputed = DisputeOrders::where('order_id', $order_id->id)->count();
        $studentrated = DB::table('ratings')->where('user_id', $order_id->student_id)->where('order_id', $order_id->id)->count();
        $tutorrated = DB::table('ratings')->where('user_id', $order_id->awarded_to)->where('order_id', $order_id->id)->count();
        $solutions = Solutions::where('order_id', $order_id->id)->get();
        $attachments = OrderAttachments::where('order_id', $order_id->id)->get();
        $bids = Bids::latest()->where('order_id', $order_id->id)->get();
        $disputes = DisputeOrders::where('order_id', $order_id->id)->first();
        $dt = Carbon::parse($disputes['created_at']);
        $subscription = $dt->addHours(24);
        $remaining = $subscription->diffForHumans();
        $bids_rating = Bids::where('order_id', $order_id->id)->first();
        $revisions = Revisions::latest()->where('order_id', $order_id->id)->get();
        //Conditions
        $seeorder = true;

        $userid = Auth::user()->id;
        //Condition number 1
        if ($order_id->student_id != $userid) {
            $seeorder = false;
        }

        if ($seeorder) {
            return view('account.orders.studentview', compact('order_id', 'bids', 'attachments', 'studentrated', 'tutorrated', 'isdisputed', 'solutions', 'disputes', 'bids_rating', 'remaining', 'revisions'));
        } else {
            return view('account.notauthorized');
        }
    }

    public function download_attachment($filename) {
        $file_path = public_path('uploads/'.$filename);
        return response()->download($file_path);
    }

    public function delete_bid($id){
        $bidder = Bids::where('id', $id)->first();
        if (Auth::user()->id == $bidder['tutor_id']) {
            $bid = Bids::find($id);
            $bid->delete();
            return redirect()->back()->with('status', 'Your bid was deleted successifully');
        } else {
            return redirect()->back()->with('fail', 'You do not own this bid');
        }
    }

    /*public function order_payment(Request $request){
        $orderdetails = Orders::where('id', request('order_id'))->first();
        $tutordetails = User::where('name', request('tutor'))->first();
        $studentdetails = User::where('id', $orderdetails->student_id)->first();

        $order_id = request('order_id');
        $tutor = request('tutor');
        $tutor_id = request('tutor_id');
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item = new Item();
        $item->setName('Order '. $order_id)
          ->setDescription('Payment for order# '.$order_id)
          ->setCurrency('USD')
          ->setQuantity(1)
          ->setPrice(request('amount'));
        $item_list = new ItemList();
        $item_list->setItems([$item]);
        $amount = new Amount();
        $amount->setCurrency('USD')
          ->setTotal(request('amount'));
        $transaction = new Transaction();
        $transaction->setAmount($amount)
          ->setItemList($item_list)
          ->setDescription('Order');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(url('/account/payment-status'))
          ->setCancelUrl(url('/account/payment-status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
          ->setPayer($payer)
          ->setRedirectUrls($redirect_urls)
          ->setTransactions(array($transaction));
        try {
          $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
          ////Mail::to($studentdetails->email)->send(new ErrorAwarding());
          Session::flash('alert', 'Something Went wrong, funds could not be loaded');
          Session::flash('alertClass', 'danger no-auto-close');
          return redirect('/payment/add-funds/paypal');
        }
        foreach ($payment->getLinks() as $link) {
          if ($link->getRel() == 'approval_url') {
            $redirect_url = $link->getHref();
            //return $redirect_url;
            break;
          }
        }
        Session::put('paypal_payment_id', $payment->getId());
        Session::put('order_id', request('order_id'));
        Session::put('tutorid', request('tutor_id'));
        Session::put('orderamount', request('amount'));
        if (isset($redirect_url)) {
          return redirect($redirect_url);
        }
        Session::flash('alert', 'Unknown error occurred');
        Session::flash('alertClass', 'danger no-auto-close');
        return redirect('/payment/add-funds/paypal');
    }*/
    private function forgetsession(){
        Session::forget('paypal_payment_id');
        Session::forget('order_id');
        Session::forget('tutorid');
        Session::forget('orderamount');
        return;
    }

    public function order_payment($id, $tutorid){
        $orderbid = Bids::where('id', $id)->where('tutor_id', $tutorid)->first();
        $countbid = Bids::where('id', $id)->where('tutor_id', $tutorid)->get();
        if ($countbid->isEmpty()) {
            return redirect()->back()->with('error', 'The bid was not found, please try again');
        }

        $orderdetails = Orders::where('id', $orderbid['order_id'])->first();
        $tutordetails = User::where('id', $orderbid['tutor_id'])->first();
        $studentdetails = User::where('id', $orderbid['student_id'])->first();

        //dd($orderdetails);

        $order_id = $orderbid['order_id'];
        $tutorname = $tutordetails['name'];
        $tutor_id = $orderbid['tutor_id'];
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item = new Item();
        $item->setName('Order '. $order_id)
          ->setDescription('Payment for order# '.$order_id)
          ->setCurrency('USD')
          ->setQuantity(1)
          ->setPrice($orderbid['amount']);
        $item_list = new ItemList();
        $item_list->setItems([$item]);
        $amount = new Amount();
        $amount->setCurrency('USD')
          ->setTotal($orderbid['amount']);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
          ->setItemList($item_list)
          ->setDescription('Order');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(url('/account/payment-status'))
          ->setCancelUrl(url('/account/payment-status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
          ->setPayer($payer)
          ->setRedirectUrls($redirect_urls)
          ->setTransactions(array($transaction));
        try {
            $payment->create($this->_api_context);
            $payy = Paypal::create([
                'payment_id' => $payment->getId(),
                'order_id' => $order_id,
                'tutorid' => $tutor_id,
                'amount' => $orderbid['amount']
            ]);
            Session::put('payment_id', $payy->payment_id);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
          //Mail::to($studentdetails->email)->send(new ErrorAwarding());
          Session::flash('alert', 'Something Went wrong, funds could not be loaded');
          Session::flash('alertClass', 'danger no-auto-close');
          return redirect('/payment/add-funds/paypal');
        }
        foreach ($payment->getLinks() as $link) {
          if ($link->getRel() == 'approval_url') {
            $redirect_url = $link->getHref();
            //dd($redirect_url);
            break;
          }
        }

        if ($payment->getId() == null) {
            Session::flash('alert', 'Something Went wrong, funds could not be loaded');
            Session::flash('alertClass', 'danger no-auto-close');
            return redirect('/payment/add-funds/paypal');
        }

        if (isset($redirect_url)) {
          return redirect($redirect_url);
        }
        Session::flash('alert', 'Unknown error occurred');
        Session::flash('alertClass', 'danger no-auto-close');
        return redirect('/payment/add-funds/paypal');
    }

    // Paypal process payment after it is done
      public function getPaymentStatus(Request $request)
      {
        $payment_id = $request->input('paymentId');
        $paypal = Paypal::where('payment_id', $payment_id)->first();
        $correctamount = $paypal['amount']/1.1;

        //dd($paypal);

        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
          Session::flash('message', 'Payment failed, please try again');
          Session::flash('alert-class', 'alert-danger');
          return redirect('/account/studentview/'.$paypal['order_id']);
        }

        $payment = Payment::get($payment_id, $this->_api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);


        if($result->getState() == 'approved') {

        $order = Orders::find($paypal['order_id']);
        $order->update([
            'awarded_to' => $paypal['tutorid'],
            'status' => 4,
            'agreed_amount' =>  $correctamount,
            'tutor_id' => $paypal['tutorid'],
            'date_awarded' => date('Y-m-d H:i:s')
        ]);

        /*id  paid_from   paid_to     description     amount  fee     order_no    order_amount    created_at  updated_at */

        $awarded_o = [
           'orderid' => $paypal['order_id']
        ];
        $orderdetails = Orders::where('id', $paypal['order_id'])->first();
        $tutordetails = User::where('id', $paypal['tutorid'])->first();
        $studentdetails = User::where('id', $orderdetails->student_id)->first();

        $thankforpayment = [
            'orderid' => $paypal['order_id'],
            'tutorname' => $tutordetails['name']
        ];
        //Email sent to buyer notifing him or her that the order was successful
        Mail::to($studentdetails['email'])->send(new ThankforPayment($thankforpayment));
        //Email sent to awarded notifing them that the order was awarded to them
        Mail::to($tutordetails['email'])->send(new Orderawarded($awarded_o));
        // Email sent to admin to notify them that there is a new order
        //Mail::to('support@homeworkbubble.com')->send(new newOrder());

          Session::flash('message', 'Funds Loaded Successfully and Tutor awarded your Order!');
          Session::flash('alert-class', 'alert-success');
          return redirect('/account/studentview/'.$paypal['order_id']);
        }
            Session::flash('message', 'Unexpected error occurred & payment has failed.');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/account/studentview/'.$paypal['order_id']);
      }


    /*public function order_payment(Request $request){
        $order_id = request('order_id');
        $tutor = request('tutor');
        $tutor_id = request('tutor_id');
        $amount = request('amount');
        $order = Orders::find($order_id);
        $order->update([
            'awarded_to' => $tutor_id,
            'status' => 4,
            'agreed_amount' =>  $amount,
            'tutor_id' => $tutor_id,
            'date_awarded' => date('Y-m-d H:i:s')
        ]);
        return redirect('/account/studentview/'.$order_id)->with('status', 'Order has been awarded');
    }*/

    public function ratestudent($id, $order)
    {
        $student_id = $id;
        $order = Orders::where('student_id', $id)->where('id', $order)->first();
        $student = User::where('id', $id)->first();
        return view('account.profile.ratestudent', compact('student', 'order', 'student_id'));
    }

    public function ratetutor($id, $order)
    {
        $tutor_id = $id;
        $order = Orders::where('awarded_to', $id)->where('id', $order)->first();
        $tutor = User::where('id', $id)->first();
        return view('account.profile.ratetutor', compact('tutor', 'order', 'tutor_id'));
    }

    public function rate_student(Request $request){
        $id = request('order_id');
        $order = Orders::first();
        $rating = new \willvincent\Rateable\Rating;
        $rating->rating = request('rating');
        $rating->comments = request('comments');
        $rating->recommend = request('recommend');
        $rating->user_id = request('user_id');
        $rating->order_id = $id;
        $order->ratings()->save($rating);
        return redirect('/account/scholarview/'.$id)->with('status', 'Thank you for your review');
    }
    public function rate_tutor(Request $request)
    {
        $id = request('order_id');
        $order = Orders::first();
        $rating = new \willvincent\Rateable\Rating;
        $rating->rating = request('rating');
        $rating->comments = request('comments');
        $rating->recommend = request('recommend');
        $rating->user_id = request('user_id');
        $rating->order_id = $id;
        $order->ratings()->save($rating);
        return redirect('/account/studentview/'.$id)->with('status', 'Thank you for your review');
    }

    public function findprojects()
    {
        $projects = Orders::latest()->where('status', 1)->paginate(50);
        $subjects = Subjects::get();
        return view('account.orders.findprojects', compact('projects', 'subjects'));
    }
    public function postproject()
    {
        $subjects = Subjects::get();
        return view('account.orders.postproject', compact('subjects'));
    }

    public function ajaxorders()
    {
        return response()->json([
            'type' => 'error',
            'text' => '<strong>You can not generate more than 20000 codes</strong>'
        ]);
        return view('account.orders.postproject');
    }

    public function addbid(Request $request){
        $bidthis = true;
        $id = request('orderid');
        $order = Orders::where('id', $id)->first();
        $student = User::where('id', $order['student_id'])->first();
        $userid = Auth::user()->id;
        $tutor = Auth::user()->name;

        $getbid = Bids::where('order_id', $id)->where('tutor_id', Auth::user()->id)->get();

        $rules = array(
            'amount' => 'required|numeric',
            'orderid' => 'required',
        );

        $messages = array(
            'amount.required' => 'Please provide a bid amount',
            'amount.numeric' => 'This is not a valid amount',
            'amount.required' => 'Please select a subject',
            'orderid.required' => 'There was an error placing a bid',

        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $bidthis = false;
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        if(!$getbid->isEmpty()){
            return redirect('/account/scholarview/'.$id)->with('fail', 'You have already placed bid for this order, delete to bid again');
        }

        if ($order['status'] != 1) {
           $bidthis = false;
           return redirect('/account/scholarview/'.$id)->with('fail', 'Order not available');
        }

        if (request('amount') < 5) {
           $bidthis = false;
           return redirect('/account/scholarview/'.$id)->with('fail', 'You can not bid below $5');
        }
        if (request('amount') > $this->shouldnotbidabove($userid)) {
           $bidthis = false;
           return redirect('/account/scholarview/'.$id)->with('fail', 'You can not bid above $'.$this->shouldnotbidabove($userid).'. Please accumulate positive reviews to bid for more');
        }
        /*if (request('amount') > $this->abovebudget(request('budget'))) {
           $bidthis = false;
           return redirect('/account/scholarview/'.$id)->with('fail', 'You can not bid more than the student budget');
        }*/
        if (request('amount') < $this->belowbudget(request('budget'))) {
           $bidthis = false;
           return redirect('/account/scholarview/'.$id)->with('fail', 'You can not bid less than the student budget');
        }
        if ($bidthis) {
            $total = request('amount') + (request('amount') * 0.1);
            $bid = Bids::create([
            'order_id' => $id,
            'tutor' => $tutor,
            'tutor_id' => $userid,
            'student_id' => $order->student_id,
            'amount' => $total,
            'homedate' => $order->homedate
            ]);
            if ($bid) {
                //email to student
                Mail::to($student['email'])->send(new TutorBid($order));
                return redirect('/account/scholarview/'.$id)->with('status', 'Proposal sent! We will email you if the client accepts your proposal ');
            }
        }
    }

    public function abovebudget($budget){
        if ($budget == '$5-$10') {
            $above = 10;
        }
        if ($budget == '$10-$30') {
            $above = 30;
        }
        if ($budget == '$30-$100') {
            $above = 100;
        }
        if ($budget == '$100-$250') {
            $above = 250;
        }
        if ($budget == '$250-$500') {
            $above = 500;
        }
        if ($budget == '$500-$1000') {
            $above = 1000;
        }
        return $above;
    }

    public function belowbudget($budget){
        if ($budget == '$5-$10') {
            $below = 5;
        }
        if ($budget == '$10-$30') {
            $below = 10;
        }
        if ($budget == '$30-$100') {
            $below = 30;
        }
        if ($budget == '$100-$250') {
            $below = 100;
        }
        if ($budget == '$250-$500') {
            $below = 250;
        }
        if ($budget == '$500-$1000') {
            $below = 500;
        }
        return $below;
    }

    public function shouldnotbidabove($id){
        $tutoraverage_review = Orders::first()->userAverageRating($id);
        $tutor_reviews = Orders::first()->userRatingCount($id);
        if ($tutor_reviews <= 5) {
            $userlevel = 25;
        }
        if ($tutor_reviews > 5 && $tutor_reviews <= 25) {
            $userlevel = 100;
        }

        if ($tutor_reviews > 25 && $tutor_reviews <= 100 && $tutoraverage_review < 9.3) {
            $userlevel = 100;
        }
        if ($tutor_reviews > 25 && $tutor_reviews <= 100 && $tutoraverage_review > 9.3) {
            $userlevel = 500;
        }
        if ($tutor_reviews > 100 && $tutoraverage_review < 9.7) {
            $userlevel = 500;
        }
        if ($tutor_reviews > 100 && $tutoraverage_review > 9.7) {
            $userlevel = 1000;
        }
        return $userlevel;
    }

    public function acelevel($id){
        $tutoraverage_review = Orders::first()->userAverageRating($id);
        $tutor_reviews = Orders::first()->userRatingCount($id);
        if ($tutor_reviews <= 5) {
            $userlevel = 'Level 1';
        }
        if ($tutor_reviews > 5 && $tutor_reviews <= 25) {
            $userlevel = 'Level 2';
        }
        if ($tutor_reviews > 25 && $tutor_reviews <= 100 && $tutoraverage_review < 9.3) {
            $userlevel = 'Level 2';
        }
        if ($tutor_reviews > 25 && $tutor_reviews <= 100 && $tutoraverage_review > 9.3) {
            $userlevel = 'Level 3';
        }
        if ($tutor_reviews > 100 && $tutoraverage_review < 9.7) {
            $userlevel = 'Level 4';
        }
        if ($tutor_reviews > 100 && $tutoraverage_review > 9.7) {
            $userlevel = 'Level 4';
        }
        return $userlevel;
    }


    public function upload_files($id)
    {
        $order_id = $id;
        return view('account.orders.uploadfiles', compact('order_id'));
    }
    public function edit_order($id)
    {
        $order = Orders::where('id', $id)->first();
        return view('account.orders.editorder', compact('order'));
    }

    public function editorder(Request $request)
    {
        $id = request('orderid');
        $order = Orders::find($id);
        $order->update([
            'subject' => request('subject'),
            'homedate' => request('homedate'),
            'description' => request('description')
        ]);
        return redirect('/account/studentview/'.$id)->with('status', 'Order successfully updated');
    }

    public function post_project(Request $request){

        $rules = array(
            'subject' => 'required',
            'level' => 'required',
            'numpages' => 'required',
            'format' => 'required',
            'homedate' => 'required|date',
            'title' => 'required|min:4|max:50',
            'description' => 'required|min:4|max:70000'
        );

        $messages = array(
            'subject.required' => 'Please select a subject',
            'budget.required' => 'Please select a budget',
            'level.required' => 'Please select a level',
            'numpages.required' => 'Please select number of pages',
            'format.required' => 'Please select Format',
            'homedate.date' => 'Format provided is not a date',
            'homedate.required' => 'Date is required',
            'title.required' => 'Please select a category',
            'title.min' => 'Title must be more than 4 characters',
            'title.max' => 'Title must not be more than 50 characters',
            'description.required' => 'Please select a Description',
            'description.min' => 'Title must be more than 4 characters',
            'description.max' => 'Description must not be more than 70000 characters'
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        } else {

            //Change date to pacific

            $pacifictime = Carbon::parse(request('homedate'))->timezone('UTC')->format('Y-m-d');
            //2018-10-20 08:00:00
            $user = Auth::user()->id;
            $order = Orders::create([
                'subject' => request('subject'),
                'title' => request('title'),
                'homedate' => request('homedate'),
                'level' => request('level'),
                'numpages' => request('numpages'),
                'format' => request('format'),
                'budget' => request('budget'),
                'description' => request('description'),
                'student_id' => $user
            ]);
            return redirect('/account/studentview/'.$order->id)->with('status', 'Order successfully posted! You should be getting bids in few minutes');
        }
    }
}
