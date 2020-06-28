<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Orders;
use Carbon\Carbon;
use App\ManualRelease;
use App\Notifications;
use App\TutorPayments;
use App\TutorWithdrawals;
use Illuminate\Http\Request;
use App\Mail\ManualReleaseRequest;
use App\Mail\ManualReleasePayment;
use Illuminate\Support\Facades\Mail;

class ManualReleaseController extends Controller
{
    public function index(){
        $manualreleases = ManualRelease::latest()->paginate(40);
        return view('admin.manualreleases.index', compact('manualreleases'));
    }

    public function request_release($id){
        //Check if the authenticated user is a tutor
        if (!Auth::user()->hasRole('tutor')) {
            abort(403, 'You can not request for manual release with other role apart from tutor');
        }
        //Check if the tutor owns the order
        $order = Orders::where('id', $id)->first();
        if ($order->tutor_id != Auth::user()->id) {
            abort(403, 'You are not allowed to request a manual release for this order');
        }
        //Check if a request had been requested earier
        $release = ManualRelease::where('order_id', $id)->get();
        if (!$release->isEmpty()) {
            abort(403, 'Manual request for this order is already pending');
        }
        //Check if 20 days has lapsed since the order was placed
        $releasedate = Carbon::parse($order->created_at)->addDays(20);
        //dd($releasedate->isPast());
        if (!$releasedate->isPast()) {
            return redirect()->back()->with('error', 'Manual release is available 20 days from project completion');
        }
        //Add release request to database
        $saverequest = ManualRelease::create([
            'order_id' => $id
        ]);
        if ($saverequest) {
            $adminemail = User::where('id', 1)->first();
            //Send email to tutor that a manual release has been started
            Mail::to($order->tutor->email)->send(new ManualReleaseRequest($order, 'tutor'));
            //Send email to admin that a tutor has requested a manual release
            Mail::to($adminemail->email)->send(new ManualReleaseRequest($order, 'admin'));
            return redirect()->back()->with('status', 'Manual release has been requested successfully. Wait for the admin to approve the request');
        }
    }

    public function approve_request($id){
        $release = ManualRelease::where('id', $id)->first();
        //check if released
        if ($release->released === 1) {
            abort(403, 'Payment for this order has already been released');
        }
        //check if 20 days are passed
        $releasedate = Carbon::parse($release->order->created_at)->addDays(20);
        if (!$releasedate->isPast()) {
            return redirect()->back()->with('error', 'Manual release is available 20 days from project completion');
        }
        //check if the order is completed
        if ($release->order->status != 5) {
            abort(403, 'There is a problem releasing payment for this order. Order status has changed');
        }
        $bidamount = (100 * $release->order->agreed_amount)/ 110;

        //Add payment to tutor
        $tutorpayment = TutorPayments::create([
            'tutor_id' => $release->order->tutor->id,
            'order_id' => $release->order_id,
            'amount' => $release->order->agreed_amount,
            'description' => 'Manual release payment for order #'.$release->order_id
        ]);
        //Determined by level
        $tutorfee = getamountbylevel($release->order->tutor, $bidamount);
        //Withdraw
        $withdraw = TutorWithdrawals::create([
            'tutor_id' => $release->order->tutor->id,
            'description' => 'Fee for order #'.$release->order_id,
            'amount' => $tutorfee,
            'transaction_id' => 'Fee-'.$release->order_id,
            'payment_method' => 'Fee'
        ]);

        // $withdraw = TutorWithdrawals::create([
        //     'tutor_id' => $orderdetails->tutor->id,
        //     'description' => 'Transaction fee for order #'.$id,
        //     'amount' =>  $order->agreed_amount - $bidamount,
        //     'transaction_id' => 'Fee-'.$id,
        //     'payment_method' => 'Fee'
        // ]);

        $notification = Notifications::create([
            'user_id' => $release->order->tutor->id,
            'description' => 'Manual release payment for order #'.$release->order_id
        ]);

        //Update release
        $updaterelease = ManualRelease::find($release->id);
        $updaterelease->update([
            'released' => 1,
        ]);

        $updateorderstatus = Orders::find($release->order->id);
        $updateorderstatus->update([
            'status' => 6
        ]);

        $adminemail = User::where('id', 1)->first();
        //Send email to tutor manual release success
        Mail::to($release->order->tutor->email)->send(new ManualReleasePayment($release->order, 'tutor'));
        //Send email to admin manual release success
        Mail::to($adminemail->email)->send(new ManualReleasePayment($release->order, 'admin'));
        //Send email to student manual release success
        Mail::to($release->order->student->email)->send(new ManualReleasePayment($release->order, 'student'));

        if ($updateorderstatus) {
            return redirect()->back()->with('status', 'Manual release was successful');
        }
    }
}
