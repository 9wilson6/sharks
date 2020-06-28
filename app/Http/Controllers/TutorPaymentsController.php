<?php

namespace App\Http\Controllers;

use Auth;
use App\TutorPayments;
use App\TutorWithdrawals;
use Illuminate\Http\Request;

class TutorPaymentsController extends Controller
{
    public function index() {
        $payments = TutorPayments::where('tutor_id', Auth::user()->id)->latest()->paginate(20);
        $withdrawals = TutorWithdrawals::where('tutor_id', Auth::user()->id)->latest()->paginate(20);
        return view('tutor.payments.index', compact('payments', 'withdrawals'));
    }
}
