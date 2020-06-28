<?php

namespace App\Http\Controllers;

use App\User;
use App\Orders;
use Carbon\Carbon;
use App\ManualRelease;
use App\StudentPayments;
use App\TutorWithdrawals;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $manualreleases = ManualRelease::latest()->limit(20)->get();
        //$orders = Orders::latest()->limit(20)->get();
        $pendingorders = Orders::latest()->limit(5)->where('status', 1)->get();
        $orders = Orders::latest()->limit(20)->where('status', 4)->get();
        $suspends = User::role('tutor')->where('status', '!=', 1)->get();              

        $data = [
            'manualreleases' => $manualreleases,
            'pendingorders' => $pendingorders,
            'suspends' => $suspends,
            'orders' => $orders
         ];
        return view('dashboard.index', compact('data'));
    }
}
