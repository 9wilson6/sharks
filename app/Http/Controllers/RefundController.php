<?php
namespace App\Http\Controllers;

use App\Bids;
use App\User;
use App\Refund;
use App\Orders;
use Carbon\Carbon;
use App\DisputeOrders;
use App\Notifications;
use App\StudentPayments;
use App\Mail\TutorRefund;
use App\TutorWithdrawals;
use App\Mail\StudentRefund;
use App\Events\BidsUpdated;
use Illuminate\Http\Request;
use App\Mail\DisputeEscalated;
use App\Events\TutorBidsUpdated;
use Illuminate\Support\Facades\Mail;

class RefundController extends Controller
{
    public function index(){        
        $refunds = Refund::latest()->where('created_at', '>', Carbon::now()->subDays(30))->paginate(40);
        return view('admin.refunds.index', compact('refunds'));
    }

    public function tutorefunds(){
        return view('tutor.refunds.index');
    }
    //Testing for disputing orders
    public function checkescallation(){
        $disputed_orders = DisputeOrders::where('created_at', '<', Carbon::now()->subHours(48))->whereHas('order', function($query) {
            $query->where('status', '!=', 6);
        })->with(['order' => function($query) { 
            $query->where('status', '!=', 6);
        }])->get();
        //Mark all escalated orders as cancelled
        foreach ($disputed_orders as $order) {
            //Mark as closed and refund order
            $this->markasclosed($order->order_id);
        }
    }
    private function markasclosed($id) {
        $orderdetails = Orders::where('id', $id)->where('status', '!=', 6)->with('tutor', 'student', 'studentwithdrawals')->get();
        if ($orderdetails->isEmpty()) {
            return true;
        }
        $orderdetails = Orders::where('id', $id)->with('tutor', 'student', 'studentwithdrawals')->first();
        $notification = Notifications::create([
            'user_id' => $orderdetails->tutor->id,
            'description' => 'Dispute has escalated and order #'.$id.' refunded'
        ]);
        //Get all withdrawals of the client with this order
        foreach ($orderdetails->studentwithdrawals as $withdrawal) {
            $studentpayment = StudentPayments::create([
                'student_id' => $orderdetails->student->id,
                'amount' => $withdrawal->amount,
                'description' => 'Refund',
                'payment_method' => 'refund',
                'transaction_id' => 'REFUND-'.$id
            ]);
        }
        //Penalize the tutor
        //Withdraw
        $withdraw = TutorWithdrawals::create([
            'tutor_id' => $orderdetails->tutor->id,
            'description' => 'Escalation fee for a dispute to order #'.$id,
            'amount' => 25,
            'transaction_id' => 'ESCALATION-'.$id,
            'payment_method' => 'Penalty'
        ]);
        //Store the refund details
        $refund = Refund::create([
            'order_id' => $id,
            'description' => 'Escalation fee for a dispute to order #'.$id,
            'refund_agent' => $orderdetails->student->name,
            'refund_agent_id' => $orderdetails->student->id
        ]);

        $order = Orders::find($id);        
        $order->update([
            'status' => 6,
        ]);
        if ($studentpayment) {
            $theadmin = User::where('id', 1)->first();
            Mail::to($orderdetails->student->email)->send(new DisputeEscalated($orderdetails, 'student'));
            Mail::to($orderdetails->tutor->email)->send(new DisputeEscalated($orderdetails, 'tutor'));
            Mail::to($theadmin->email)->send(new DisputeEscalated($orderdetails, 'admin'));
        }
        return true;
    }
}
