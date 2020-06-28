<?php

namespace App\Http\Controllers;

use Auth;
use App\Orders;
use App\Refund;
use App\DisputeOrders;
use App\Notifications;
use App\StudentPayments;
use App\TutorWithdrawals;
use App\Mail\TutorRefund;
use App\Mail\StudentRefund;
use Illuminate\Http\Request;
use App\Mail\WithdrawDispute;
use App\Events\TutorOrdersUpdated;
use App\Events\StudentOrdersUpdated;
use Illuminate\Support\Facades\Mail;

class DisputesController extends Controller
{
    public function index(){        
        $disputes = DisputeOrders::latest()->paginate(40);
        return view('admin.disputes.index', compact('disputes'));
    }

    public function withdraw($id) {
        $orderdetails = Orders::where('id', $id)->with('tutor', 'student')->first();
        DisputeOrders::where('order_id', $id)->delete();
        $order = Orders::find($id);
        $order->update([
            'status' => 5,
        ]);
        $notification = Notifications::create([
            'user_id' => $orderdetails->tutor->id,
            'description' => 'The admin has withdrawn dispute for order #'.$id,
        ]);
        Mail::to($orderdetails->tutor->email)->send(new WithdrawDispute($id));
        $broadcastorderstudent = Orders::with('ratings', 'tutor', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
        $broadcastorderstutor = Orders::with('bids', 'tutor', 'ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
        broadcast(new StudentOrdersUpdated($broadcastorderstudent))->toOthers();
        broadcast(new TutorOrdersUpdated($broadcastorderstutor))->toOthers();
        return redirect()->route('admin.disputes', $id)->with('status', 'Dispute withdrawn');
    }

    public function refund($id) {
        //check if order exist
        $order = Orders::where('id', $id)->get();
        if ($order->isEmpty()) {
            return redirect()->route('admin.disputes', $id)->with('error', 'Order does not exist');
        }
        //check if the order has already been refunded
        $order = Orders::where('id', $id)->with('refund', 'tutor', 'student', 'studentwithdrawals')->first();
        //dd($order);
        if ($order->refund) {
            return redirect()->route('admin.disputes', $id)->with('error', 'This order has already been refunded');
        }
        $notification = Notifications::create([
            'user_id' => $order->tutor->id,
            'description' => 'Admin has refunded order # '.$id.' and a fee of $25 has been charged in you account',
        ]);
        //Store the refund details
        $refund = Refund::create([
            'order_id' => $id,
            'description' => 'Escalation fee for a dispute to order #'.$id,
            'refund_agent' => 'admin',
            'refund_agent_id' => Auth::user()->id
        ]);
        //Add student payment from refund to database
        foreach ($order->studentwithdrawals as $withdrawal) {
            $studentpayment = StudentPayments::create([
                'student_id' => $order->student->id,
                'amount' => $withdrawal->amount,
                'description' => 'Refund',
                'payment_method' => 'refund',
                'transaction_id' => 'REFUND-'.$id
            ]);
        }
        //Deduct escalation fee from the tutors account
        $withdraw = TutorWithdrawals::create([
            'tutor_id' => $order->tutor->id,
            'description' => 'Escalation fee for a dispute to order #'.$id,
            'amount' => 25,
            'transaction_id' => 'ESCALATION-'.$id,
            'payment_method' => 'penalty'
        ]);
        if ($studentpayment) {
           Mail::to($order->student->email)->send(new StudentRefund($id));
           Mail::to($order->tutor->email)->send(new TutorRefund($id));
        }
        //change order status
        $order = Orders::find($id);        
        $order->update([
            'status' => 6,
        ]);
        $broadcastorderstudent = Orders::with('ratings', 'tutor', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
        $broadcastorderstutor = Orders::with('bids', 'tutor', 'ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
        broadcast(new StudentOrdersUpdated($broadcastorderstudent))->toOthers();
        broadcast(new TutorOrdersUpdated($broadcastorderstutor))->toOthers();
        return redirect()->route('admin.disputes')->with('status', 'Refund to student was successful, $20 has been deducted from the tutor account'); 
    }
}
