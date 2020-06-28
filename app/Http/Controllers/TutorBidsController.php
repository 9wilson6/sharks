<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Bids;
use Validator;
use App\Orders;
use App\Mail\TutorBid;
use App\Events\BidsUpdated;
use Illuminate\Http\Request;
use App\Events\AdminBidsUpdated;
use App\Events\TutorBidsUpdated;
use App\Events\TutorOrdersUpdated;
use App\Events\StudentOrdersUpdated;
use Illuminate\Support\Facades\Mail;

class TutorBidsController extends Controller
{
    public function index() {
        $bids = Bids::latest()->where('tutor_id', Auth::user()->id)->with('order')->paginate(20);
        return view('tutor.bids.index', compact('bids'));
    }

    public function tutorbids($order_id) {
        $bids = Bids::latest()->where('order_id', $order_id)->with('tutor', 'order')->get();
        foreach ($bids as $bid) {
            $bid->tutorratings = $bid->tutor->ratings->count();
        }
        return $bids;
    }

    public function delete($id){
        $bidder = Bids::where('id', $id)->first();
        if (Auth::user()->id == $bidder->tutor_id) {
            $bid = Bids::find($id);
            $bid->delete();
            broadcast(new TutorBidsUpdated($bidder->order_id))->toOthers();
            broadcast(new AdminBidsUpdated($bidder->order_id))->toOthers();
            broadcast(new BidsUpdated($bidder->order_id))->toOthers();
            return redirect('/account/orders/'.$bidder->order_id)->with('status', 'Your bid was deleted successfully');
        } else {
            return redirect('/account/orders/'.$bidder->order_id)->with('fail', 'You do not own this bid');
        }
    }

    public function add(Request $request, $orderid) {
        $rules = array(
            'amount' => 'required|numeric'
        );
        $messages = array(
            'amount.required' => 'Please provide a bid amount',
            'amount.numeric' => 'This is not a valid amount'
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $getbid = Bids::where('order_id', $orderid)->where('tutor_id', Auth::user()->id)->get();
        $order = Orders::where('id', $orderid)->with('student')->first();

        if(!$getbid->isEmpty()){
            return redirect()->route('tutor.order', $orderid)->with('fail', 'You have already placed bid for this order, delete to bid again');
        }

        if ($order['status'] != 1) {
           return redirect()->route('tutor.order', $orderid)->with('fail', 'Order not available for bidding');
        }

        if (request('amount') < 5) {
           return redirect()->route('tutor.order', $orderid)->with('fail', 'You can not bid below $5');
        }
        if (request('amount') > $this->shouldnotbidabove()) {
           return redirect()->route('tutor.order', $orderid)->with('fail', 'You can not bid above $'.$this->shouldnotbidabove().'. Please accumulate positive reviews to bid for more');
        }

        if (request('amount') < $this->belowbudget($order['budget'])) {
           return redirect()->route('tutor.order', $orderid)->with('fail', 'You can not bid less than the student budget');
        }

        if (Auth::user()->profile->verified != 1) {
            abort(403, 'You are not allowed to bid, Kindly complete your profile and add your academic certifications, If you have already done so, wait for verification from the admin');
        }

        $total = request('amount') + (request('amount') * 0.1);
        $bid = Bids::create([
            'order_id' => $orderid,
            'tutor_id' => Auth::user()->id,
            'amount' => $total
        ]);

        if ($bid) {
            broadcast(new TutorBidsUpdated($orderid))->toOthers();
            broadcast(new AdminBidsUpdated($orderid))->toOthers();
            broadcast(new BidsUpdated($orderid))->toOthers();
            //email to student
            Mail::to($order->student->email)->send(new TutorBid($order));
            return redirect()->route('tutor.order', $orderid)->with('status', 'Proposal sent! We will email you if the client accepts your proposal ');
        }
    }

    public function shouldnotbidabove(){
        $tutoraverage_review = Auth::user()->averageRating();
        $tutor_reviews = Auth::user()->ratings->count();
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
}
