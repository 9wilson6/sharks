<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Orders;
use App\Subjects;
use App\Bids;
use App\DisputeOrders;
use App\OrderPayments;
use App\Notifications;
use App\Payments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ChangedPassword;

class Account extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Active = 1
        // Cancelled = 2
        // Disputed = 3
        // In progress = 4 
        // Completed = 5
        // Closed = 6
        // Refunded = 7
        // Revision = 8

        if (Auth::user()->role == 'tutor') {
            $disputed = Orders::latest()->where('status', 3)->where('awarded_to', Auth::user()->id)->paginate(20);
            $totalamount = Payments::where('paid_to', Auth::user()->id)->sum('amount');
            $awarded = Orders::where('awarded_to', Auth::user()->id)->count();
            $disputedd = Orders::where('status', 3)->where('awarded_to', Auth::user()->id)->count();
            $notifications = Notifications::latest()->where('user_id', Auth::user()->id)->limit(5)->get();            
            $orders = Orders::latest()->whereIn('status', array(1, 4, 5, 6, 8))->where('awarded_to', Auth::user()->id)->paginate(20);
            return view('account.dashboard', compact('disputed', 'orders', 'totalamount', 'awarded', 'disputedd', 'notifications'));
        } elseif(Auth::user()->role == 'student') {
           $disputed = Orders::latest()->where('status', 3)->where('student_id', Auth::user()->id)->paginate(20);
            $orders = Orders::latest()->whereIn('status', array(1, 4, 5, 6, 8))->where('student_id', Auth::user()->id)->paginate(20);
            return view('account.dashboard', compact('disputed', 'orders'))->with(['controller'=>$this]);;
        }
    }

    public function no_bid($id){
        $no_bids = Bids::where('order_id', $id)->count();
        return $no_bids;
    }

    public function hasbid($id, $project){
        $hasbid = Bids::where('tutor_id', $id)->where('order_id', $project)->count();
        if ($hasbid > 0) {
            return true;
        }
    }

    public function profile()
    {
        $id = Auth::user()->id;
        $totalamount = Payments::where('paid_to', $id)->sum('amount');
        $tutoraverage_review = Orders::first()->userAverageRating($id);
        $tutor_reviews = Orders::first()->userRatingCount($id);
        if ($tutoraverage_review == null) {
            $tutoraverage_review = 0;
        }
        $subjects = Subjects::get();
        return view('account.profile.profile', compact('tutoraverage_review', 'tutor_reviews', 'totalamount', 'subjects'));
    }

    public function student_profile($id)
    {
        $posted = Orders::where('student_id', $id)->count();
        $awarded = Orders::where('student_id', $id)->whereNotNull('awarded_to')->count();
        $disputed = Orders::where('student_id', $id)->where('status', 3)->count();
        $refunded = Orders::where('student_id', $id)->where('status', 7)->count();

        $reviews = DB::table('ratings')->where('user_id', $id)->orderBy('id', 'DESC')->get();
        return view('account.profile.studentprofile', compact('posted', 'awarded', 'disputed', 'refunded', 'reviews'));
    }

    public function payments()
    {
        $userid = Auth::user()->id;
        if (Auth::user()->role == 'tutor') {
            $tutorpayments = Payments::where('paid_to', $userid)->orderBy('id', 'DESC')->paginate(20);
            $totalamount = Payments::where('paid_to', $userid)->sum('amount');
            $paypalemail = Auth::user()->payment_email;
        } elseif(Auth::user()->role == 'student') {
            $studentpayments = OrderPayments::where('paid_from', $userid)->orderBy('id', 'DESC')->paginate(20);
        }
        return view('account.profile.payments', compact('tutorpayments', 'studentpayments', 'paypalemail', 'totalamount'));
    }

    public function scholaronline()
    {
        //$average_review = Orders::first()->userAverageRating($id);
        //$tutor_reviews = Orders::first()->userRatingCount($id);
        $scholars = User::where('role', 'tutor')->get();
        return view('account.orders.scholarsonline', compact('scholars'));
    }



    public function editprofile()
    {
        $userid = Auth::user()->id;
        $useraccount = User::where('id', $userid)->first();
        $subjects = Subjects::get();
        $ischecked = true;
        return view('account.profile.editprofile', compact('useraccount', 'subjects', 'ischecked'));
    }

    public function changepass()
    {
        return view('account.profile.changepass');
    }    

    public function scholarprofile($id)
    {
        $userdetails = User::where('id', $id)->first();
        $subjects = Subjects::get();
        $reviews = DB::table('ratings')->where('user_id', $id)->orderBy('id', 'DESC')->paginate(20);
        $tutoraverage_review = Orders::first()->userAverageAccountRating($id);
        $tutor_reviews = Orders::first()->userRatingCount($id);
        return view('account.profile.scholarprofile', compact('userdetails', 'subjects', 'reviews', 'tutoraverage_review', 'tutor_reviews'));
    }

    public function subscriptions()
    {
        return view('account.profile.subscriptions');
    }

    public function upgrade_subscription()
    {
        return view('account.profile.upgradesubscription');
    }

    public function mybookmarks()
    {
        return view('account.profile.mybookmarks');
    }

    public function proposals()
    {
        $userid = Auth::user()->id;
        $proposals = Bids::where('tutor_id', $userid)->paginate(20);
        return view('account.proposals', compact('proposals'));
    }
    public function scholarhelp()
    {
        return view('account.scholarhelp');
    }

    public function changepassword(Request $request)
    {
        $userid = Auth::user()->id;
        $user = User::find($userid);
        $user->update([
            'password' => bcrypt(request('password'))
        ]);

        $email = [
          'user' => Auth::user()->name,
          'email' => Auth::user()->email,
          'password' => request('password')
        ];
        Mail::to(Auth::user()->email)->send(new ChangedPassword($email));
        return redirect()->back()->with('status', 'Password changed successfully');
    }

    public function status($userid)
    {
             
    }

}
