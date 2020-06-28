<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use App\Bids;
use App\Orders;
use PayPal\Api\Item;
use PayPal\Api\Payer;
use App\TutorPayments;
use App\TutorWithdrawals;
use App\Notifications;
use PayPal\Api\Amount;
use App\OrderPayments;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use App\StudentPayments;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use App\StudentWithdrawals;
use Illuminate\Http\Request;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use App\Events\TutorOrdersUpdated;
use App\Events\StudentOrdersUpdated;
use Illuminate\Support\Facades\Mail;
use PayPal\Auth\OAuthTokenCredential;
use App\Mail\Orderawarded;
use App\Mail\ThankforPayment;
use App\Mail\ReleasePayment;

use App\Mail\StudentAddPayment;
use App\Mail\AdminStudentAddPayment;

class StudentPaymentsController extends Controller
{
    private $_api_context;

    public function __construct() {
        $paypal_conf = config('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function index() {
        $payments = StudentPayments::where('student_id', Auth::user()->id)->latest()->paginate(20);
        $withdrawals = StudentWithdrawals::where('student_id', Auth::user()->id)->latest()->paginate(20);
        return view('student.payments.index', compact('payments', 'withdrawals'));
    }

    public function payorder($id){
        $bidetails = Bids::where('id', $id)->with('tutor', 'order')->first();
        $countbid = Bids::where('id', $id)->get();
        if ($countbid->isEmpty()) {
            return redirect()->back()->with('error', 'The bid was not found, please try again');
        }
        if ($bidetails->order->status != 1) {
            return redirect()->back()->with('error', 'This order can not be awarded, seems to have already awarded. Contact support if you think this is a mistake');
        }
        //check how much balance the student have
        $student_balance = $this->checkbalance();
        //dump($student_balance);
        //dd($bidetails->amount);
        if ($student_balance >= (int) $bidetails->amount) {
          //Award order
          $order = Orders::find($bidetails->order_id);
          $order->update([
              'status' => 4,
              'agreed_amount' =>  $bidetails->amount,
              'tutor_id' => $bidetails->tutor_id,
              'date_awarded' => date('Y-m-d H:i:s')
          ]);
          //Email sent to awarded notifing them that the order was awarded to them
          Mail::to($bidetails->tutor->email)->send(new Orderawarded($order->id));
          //Save withdrawal
          $bidamount = (100 * $bidetails->amount)/ 110;
          if ($order) {
                $withdrawal = StudentWithdrawals::create([
                    'student_id' => Auth::user()->id,
                    'order_id' => $bidetails->order_id,
                    'amount' => $bidamount,
                    'description' => 'Award of order #'.$bidetails->order_id.' to tutor '.$bidetails->tutor->name
                ]);
                $withdrawal = StudentWithdrawals::create([
                    'student_id' => Auth::user()->id,
                    'order_id' => $bidetails->order_id,
                    'amount' => $bidetails->amount - $bidamount,
                    'description' => 'Award of order #'.$bidetails->order_id.' to tutor '.$bidetails->tutor->name.' fee'
                ]);
                if ($withdrawal) {
                    //Email sent to student. Award success
                    Mail::to(Auth::user()->email)->send(new ThankforPayment($bidetails));
                }
                // Email sent to admin to notify them that there is a new order
                //Mail::to('support@homeworkbubble.com')->send(new newOrder());
                $broadcastorderstudent = Orders::with('ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $bidetails->order_id)->first();
                $broadcastorderstutor = Orders::with('bids', 'ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $bidetails->order_id)->first();
                broadcast(new StudentOrdersUpdated($broadcastorderstudent))->toOthers();
                broadcast(new TutorOrdersUpdated($broadcastorderstutor))->toOthers();
                return redirect()->route('student.order.details', $bidetails->order_id)->with('status', 'Funds Loaded Successfully and Tutor '.$bidetails->tutor->name.' awarded your Order!');
          }
        } else {
            Session::put('bidid', $bidetails->id);
            //If student does not have more than 50% of the order total redirect them to add payment page with warning
            return redirect()->route('student.addfunds', ['amount' => $bidetails->amount - $student_balance])->with('error', 'You do not have enough money to award to this tutor, Add funds to proceed');
        }
    }

    // public function payorder($id){
    //     $bidetails = Bids::where('id', $id)->with('tutor', 'order')->first();
    //     $countbid = Bids::where('id', $id)->get();
    //     if ($countbid->isEmpty()) {
    //         return redirect()->back()->with('error', 'The bid was not found, please try again');
    //     }
    //     if ($bidetails->order->status != 1) {
    //         return redirect()->back()->with('error', 'This order can not be awarded, seems to have already awarded. Contact support if you think this is a mistake');
    //     }
    //     //check how much balance the student have
    //     $student_balance = $this->checkbalance();
    //     if ($student_balance > $bidetails->amount) {
    //       //Award order
    //       $order = Orders::find($bidetails->order_id);
    //       $order->update([
    //           'status' => 4,
    //           'agreed_amount' =>  $bidetails->amount,
    //           'tutor_id' => $bidetails->tutor_id,
    //           'date_awarded' => date('Y-m-d H:i:s')
    //       ]);
    //       //Email sent to awarded notifing them that the order was awarded to them
    //       Mail::to($bidetails->tutor->email)->send(new Orderawarded($order->id));
    //       //Save withdrawal
    //       $bidamount = (100 * $bidetails->amount)/ 110;
    //       if ($order) {
    //             $withdrawal = StudentWithdrawals::create([
    //                 'student_id' => Auth::user()->id,
    //                 'order_id' => $bidetails->order_id,
    //                 'amount' => $bidamount,
    //                 'description' => 'Award of order #'.$bidetails->order_id.' to tutor '.$bidetails->tutor->name
    //             ]);
    //             $withdrawal = StudentWithdrawals::create([
    //                 'student_id' => Auth::user()->id,
    //                 'order_id' => $bidetails->order_id,
    //                 'amount' => $bidetails->amount - $bidamount,
    //                 'description' => 'Award of order #'.$bidetails->order_id.' to tutor '.$bidetails->tutor->name.' fee'
    //             ]);
    //             if ($withdrawal) {
    //                 //Email sent to student. Award success
    //                 Mail::to(Auth::user()->email)->send(new ThankforPayment($bidetails));
    //             }
    //             // Email sent to admin to notify them that there is a new order
    //             //Mail::to('support@homeworkbubble.com')->send(new newOrder());
    //             $broadcastorderstudent = Orders::with('ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $bidetails->order_id)->first();
    //             $broadcastorderstutor = Orders::with('bids', 'ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $bidetails->order_id)->first();
    //             broadcast(new StudentOrdersUpdated($broadcastorderstudent))->toOthers();
    //             broadcast(new TutorOrdersUpdated($broadcastorderstutor))->toOthers();
    //             return redirect()->route('student.order.details', $bidetails->order_id)->with('status', 'Funds Loaded Successfully and Tutor '.$bidetails->tutor->name.' awarded your Order!');
    //       }
    //     } else {
    //       //If student does not have more than 50% of the order total redirect them to add payment page with warning
    //       return redirect()->route('student.addfunds', ['amount' => $bidetails->amount - $student_balance])->with('error', 'You do not have enough money to award to this tutor, Add funds to proceed');
    //     }
    // }

    private function checkbalance(){
        $total_payments = Auth::user()->studentpayments->sum('amount');
        $total_withdrawals = Auth::user()->studentwithdrawal->sum('amount');
        return $total_payments - $total_withdrawals;
    }

    public function addpayments() {
      return view('student.payments.add');
    }

    public function payViaPaypal(Request $request) {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $paymentfee = new Item();
        $paymentfee->setName('Transaction fee')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice(request('fee'));
        $payment = new Item();
        $payment->setName('Add funds')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice(request('amount'));
        $item_list = new ItemList();
        $item_list->setItems(array($payment, $paymentfee));
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal(request('totalamount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Add funds '. defaultsettings()['sitename']);
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(route('paypal.verify'))
            ->setCancelUrl(route('student.addfunds'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                return response()->json([
                    'errors' => [
                        0 => ['Connection timeout. Try again']
                        ]
                ], 422);
            } else {
                return response()->json([
                    'errors' => [
                        0 => ['Some error occur, sorry for inconvenience caused. try again']
                        ]
                ], 422);
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        $sessiondata = [
            'paypal_payment_id' => $payment->getId(),
            'amount' => request('amount'),
            'fee' => request('fee'),
        ];
        Session::put('sessiondata', $sessiondata);
        if (isset($redirect_url)) {
            return response()->json([
                'link' => $redirect_url
            ]);
        }
        return response()->json([
            'errors' => [
                0 => ['Unknown error occurred, contact admin']
                ]
        ], 422);
    }

    public function getPaymentStatus(Request $request) {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('sessiondata');
        /** clear the session payment ID **/
        Session::forget('sessiondata');
        if (empty($request->get('PayerID')) || empty($request->get('token'))) {
            return redirect()->route('student.addfunds')->with('status', 'Payment failed. Try again');
        }
        $payment = Payment::get($payment_id['paypal_payment_id'], $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {
            //Add student payment to database
            $studentpayment = StudentPayments::create([
                'student_id' => Auth::user()->id,
                'amount' => $payment_id['amount'],
                'description' => 'Add funds',
                'payment_method' => 'Paypal',
                'transaction_id' => $payment_id['paypal_payment_id']
            ]);
            if ($studentpayment) {
                $adminemail = User::where('id', 1)->first();
                //Send email to student notify them that funds were loaded successfully
                Mail::to(Auth::user()->email)->send(new StudentAddPayment(Auth::user(), $studentpayment));
                //Send email to admin
                Mail::to($adminemail->email)->send(new AdminStudentAddPayment(Auth::user(), $studentpayment));
                return redirect()->route('student.addfunds')->with('status', 'Funds added successfully. Thank you for your payment');
            }
        }
        return redirect()->route('student.addfunds')->with('status', 'Payment failed. Try again');

    }

    public function release_payment($id) {
        $orderdetails = Orders::where('id', $id)->with('student', 'tutor')->first();
        if ($orderdetails->student_id != Auth::user()->id) {
            return redirect()->back()->with('error', 'You are performing a forbidden action');
        }
        $order = Orders::find($id);
        $order->update([
            'status' => 6,
        ]);
        $bidamount = (100 * $order->agreed_amount)/ 110;
        //Add payment to tutor

        //Get the bid amount
        $tutorpayment = TutorPayments::create([
            'tutor_id' => $orderdetails->tutor->id,
            'order_id' => $id,
            'amount' => $bidamount,//$order->agreed_amount,
            'description' => 'Payment for order #'.$id
        ]);

        //Determined by level
        $tutorfee = getamountbylevel($orderdetails->tutor, $bidamount);
        //Withdraw
        $withdraw = TutorWithdrawals::create([
            'tutor_id' => $orderdetails->tutor->id,
            'description' => 'Fee for order #'.$id,
            'amount' => $tutorfee,
            'transaction_id' => 'Fee-'.$id,
            'payment_method' => 'Fee'
        ]);
        //With 10 %
        //Remove the 10% fee

        // $withdraw = TutorWithdrawals::create([
        //     'tutor_id' => $orderdetails->tutor->id,
        //     'description' => 'Transaction fee for order #'.$id,
        //     'amount' => $order->agreed_amount - $bidamount,
        //     'transaction_id' => 'Fee-'.$id,
        //     'payment_method' => 'Fee'
        // ]);

        $notification = Notifications::create([
            'user_id' => $orderdetails->tutor->id,
            'description' => 'Student has released payment for order #'.$id,
        ]);
        Mail::to($orderdetails->tutor->email)->send(new ReleasePayment($orderdetails));
        //Mail::to($orderdetails->student->email)->send(new ThankforRelease($opayment));

        $broadcastorderstudent = Orders::with('ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
        $broadcastorderstutor = Orders::with('bids', 'ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
        broadcast(new StudentOrdersUpdated($broadcastorderstudent))->toOthers();
        broadcast(new TutorOrdersUpdated($broadcastorderstutor))->toOthers();

        return redirect()->route('student.order.details', $id)->with('status', 'You have released payment to tutor, thank you');
    }

}
