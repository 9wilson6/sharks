<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;
use App\Orders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Solutions;
use App\OrderAttachments;
use App\Bids;
use App\DisputeOrders;
use Carbon\Carbon;
use App\Revisions;
use App\User;


class OrdersApiController extends Controller
{
    public function tutorbids($order_id)
    {
        $tutorbids = Bids::latest()->where('order_id', $order_id)->get();
        foreach ($tutorbids as $bids) {
            $bids->ratings = $this->ratings($bids->tutor_id);
            $bids->onlinestatus = $this->getstatus($bids->tutor_id);
        }
        return $tutorbids;
    }

    public function ratings($user) {
        $ratings = Orders::first()->userRatingCount($user);
        return $ratings;
    }

    public function getstatus($user) {
        $status = file_get_contents(defaultsettings()['siteurl'].'/cometchat/cometchat_getid.php?userid='.$user);
        return $status;
    }

    /* public function getstatus($user)
    {
        $status = 'online';
        return $status;
    } */

    public function scholaronline()
    {
        $tutors = User::where('role', 'tutor')->get();
        foreach ($tutors as $scholar) {
            $scholar->ratingscount = $this->getratingcount($scholar->id);
            $scholar->avratings = $this->getaveragerating($scholar->id);
            $scholar->onlinestatus = $this->getstatus($scholar->id);
        }
        //return $tutors;
        return view('account.orders.scholarsonline', compact('tutors'));
    }

    public function getaveragerating($user){
        return Orders::first()->userAverageRating($user);
    }

    public function getratingcount($user){
        return Orders::first()->userRatingCount($user);
    }

    public function checkecscalated($user){
        $orders = DisputeOrders::where('escalated', 0)->get();
        $timenow = Carbon::parse($order->created_at)->addHour('24');
        if (condition) {
            # code...
        }

    }

    public function escalate_dispute(){
        $orders = DisputeOrders::where('escalated', 0)->get();        
        foreach ($orders as $order) {
            $after = Carbon::parse($order->created_at)->addHour('24');
            $after24 = strtotime($after);
            $todaynowe = date('Y-m-d H:i:s', time());
            $todaynow = strtotime($todaynowe);
            if ($todaynow > $after24) {
                $escorder = DisputeOrders::find($order->id);
                $escorder->update([
                    'escalated' => 1
                ]);
                $disputeorder = Orders::find($order->order_id);
                $disputeorder->update([
                    'status' => 6
                ]);
            }
        }
    }
   
}
