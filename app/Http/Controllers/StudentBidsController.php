<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Bids;
use App\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;

class StudentBidsController extends Controller
{
    public function index($order_id) {
        $bids = Bids::latest()->with('tutor')->where('order_id', $order_id)->get();
        foreach ($bids as $bid) {
            $bid->tutorratings = $bid->tutor->ratings->count();
        }
        return $bids;
    }
}
