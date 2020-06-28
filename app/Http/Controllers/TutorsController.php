<?php

namespace App\Http\Controllers;

use App\User;
use App\Orders;
use App\Subjects;
use App\TutorPayments;
use App\UserAttachments;
use App\TutorWithdrawals;
use Illuminate\Support\Str;
use App\Mail\UserResetPass;
use Illuminate\Http\Request;
use App\Mail\TutorWithdrawal;
use App\UserProfileController;
use App\Mail\TutorSignupEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class TutorsController extends Controller {

    public function index() {
        $users = User::role('tutor')->latest()->paginate(15);
        return view('tutor.index', compact('users'));
    }

    public function create() {
        return view('tutor.add');
    }

    public function store(Request $request) {
        $rules = [
            'password' => 'required|confirmed:password',
            'fullname' => 'required',
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users'
		];
		$customMessages = [
            'password.required' => 'Password is required',
            'password.confirmed' => 'Confirm password provided does not match',
            'fullname.required' => 'Tutor full name is required',
            'name.required' => 'Tutor username is required',
            'name.unique' => 'Username provided is already in use',
            'email.required' => 'Email address is required',
            'email.email' => 'Email address provided is invalid',
            'email.unique' => 'Email address provided is already in use'
        ];
        $this->validate($request, $rules, $customMessages);
        try {
            $user = User::create([
                'name' => request('name'),
                'email' => request('email'),
                'password' => bcrypt(request('password')),
                'fullname' => request('fullname')
            ]);
            if ($user) {
                $clientprofile = UserProfileController::create([
                    'user_id' => $user->id
                ]);
            }
            $user->assignRole('tutor');
            if (request('sendemail') != null) {
                Mail::to($user->email)->send(new TutorSignupEmail($user, request('password')));
            }
            return redirect()->route('admin.tutors')->with('status', 'Tutor has been added successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function awarded($id) {
        $tutor = User::where('id', $id)->with('orderawards')->first();
        return view('tutor.awarded', compact('tutor'));
    }

    public function disputed($id) {
        $tutor = User::where('id', $id)->with('disputedorders')->first();
        return view('tutor.disputed', compact('tutor'));
    }

    public function bids($id) {
        $bids = User::where('id', $id)->with('bids')->paginate(20);
        return view('tutor.bids', compact('bids'));
    }

    public function edit($id) {
        $tutor = User::where('id', $id)->first();
        return view('tutor.edit', compact('tutor'));
    }

    public function update(Request $request, $id) {
        $rules = [
            'name' => 'required|unique:users,name,'. $id .'',
            'email' => 'required|email|max:255|unique:users,email,'. $id .'',
            'fullname' => 'required'
		];
		$customMessages = [
            'name.unique' => 'That Username already in use by another User',
            'email.unique' => 'That Email already is used by another User',
            'fullname.required' => 'Student full name is required',
            'email.required' => 'Email address is required',
            'email.email' => 'Email address provided is invalid'
        ];
        $this->validate($request, $rules, $customMessages);
        $user = User::find($id);
        $user->update([
            'name' => request('name'),
            'email' => request('email'),
            'fullname' => request('fullname')
        ]);
        if ($user) {
            return redirect()->route('admin.tutors')->with('status', 'Tutor has been updated successfully');
        }
    }

    public function suspend($id){
        $user = User::where('id', $id)->get();
        if ($user->isEmpty()) {
            return redirect()->route('admin.tutors')->with('error', 'User does not exist');
        }
        $theuser = User::find($id);
        $theuser->update([
            'status' => 0
        ]);
        if ($theuser) {
            return redirect()->route('admin.tutors')->with('status', 'Tutor has been suspended successfully');
        }
    }

    public function unsuspend($id){
        $user = User::where('id', $id)->get();
        if ($user->isEmpty()) {
            return redirect()->route('admin.tutors')->with('error', 'User does not exist');
        }
        $theuser = User::find($id);
        $theuser->update([
            'status' => 1
        ]);
        if ($theuser) {
            return redirect()->route('admin.tutors')->with('status', 'Tutor has been unsuspended successfully');
        }
    }

    public function verify($id){
        $user = User::where('id', $id)->get();
        if ($user->isEmpty()) {
            return redirect()->route('admin.tutors')->with('error', 'User does not exist');
        }
        $user = UserProfileController::where('user_id', $id)->first();
        $userprofile = UserProfileController::find($user->id);
        $userprofile->update([
            'verified' => 1
        ]);
        if ($userprofile) {
            return redirect()->route('admin.tutors')->with('status', 'Tutor has been verified successfully');
        }
    }

    public function unverify($id){
        $user = User::where('id', $id)->get();
        if ($user->isEmpty()) {
            return redirect()->route('admin.tutors')->with('error', 'User does not exist');
        }
        $user = UserProfileController::where('user_id', $id)->first();
        $userprofile = UserProfileController::find($user->id);
        $userprofile->update([
            'verified' => null
        ]);
        if ($userprofile) {
            return redirect()->route('admin.tutors')->with('status', 'Tutor has been unverified successfully');
        }
    }

    public function reset($id){
        $genpass = Str::random(8);
        $pass = strtolower($genpass);
        $user = User::find($id);
        $user->update([
            'password' => bcrypt($pass),
        ]);
        Mail::to($user->email)->send(new UserResetPass($user, $pass));
        return redirect()->route('admin.tutors')->with('status', 'Password for user '.$user->email.' has been reset to '.$pass);
    }

    public function pass_change() {
        return view('tutor.passchange');
    }

    public function changepass(Request $request, $id) {
        $rules = [
			'newpassword' => 'required|confirmed'
		];
		$customMessages = [
            'newpassword.required' => 'New password is required',
            'newpassword.confirmed' => 'Confirm password should be the same as new password'
        ];
        $this->validate($request, $rules, $customMessages);
        $pass = User::where('id', $id)->get();
        if ($pass->isEmpty()) {
            return redirect()->route('admin.tutors')->with('error', 'User does not exist');
        }
        $user = User::findOrFail($id);
        $user->fill([
            'password' => Hash::make(request('newpassword'))
        ])->save();
        return redirect()->route('admin.tutors')->with('status', 'Password was updated successfully');
    }

    public function destroy($id) {
        $deleteuser = User::find($id);
        $deleteuser->delete();
        return redirect()->route('admin.tutors')->with('status', 'User was deleted successfully');
    }

    public function scholarprofile($id) {
        $userdetails = User::where('id', $id)->first();
        $subjects = Subjects::get();
        $reviews = $userdetails->ratings()->orderBy('id', 'DESC')->paginate(20);
        $tutoraverage_review = $userdetails->averageRating();
        $tutor_reviews = $userdetails->ratings->count();
        $acelevel = getacelevel($userdetails);
        return view('admin.account.scholarprofile', compact('userdetails', 'acelevel', 'subjects', 'reviews', 'tutoraverage_review', 'tutor_reviews'));
    }

    public function download($id, $user) {
        $attach = UserAttachments::where('id', $id)->first();
        $file_path = storage_path('app/user/attachments/'.$user.'/'.$attach->filename);
        return response()->download($file_path);
    }

    public function withdraw(Request $request, $id) {
        $rules = [
            'amount' => 'required|numeric',
            'description' => 'required',
            'fee' => 'numeric',
            'transaction_id' => 'required',
            'payment_method' => 'required'
		];
		$customMessages = [
            'amount.required' => 'Withdrawal amount is required',
            'amount.numeric' => 'Withdrawal amount provided is invalid, provide a numeric input',
            'fee.required' => 'Withdrawal fee is required',
            'fee.numeric' => 'Withdrawal fee provided is invalid, provide a numeric input',
            'description.required' => 'Withdrawal description is required',
            'transaction_id.required' => 'Transaction id is required',
            'payment_method.required' => 'Payment method is required'
        ];
        $this->validate($request, $rules, $customMessages);
        $tutor = User::where('id', $id)->get();
        if ($tutor->isEmpty()) {
            return redirect()->route('admin.tutors')->with('error', 'User does not exist');
        }
        //Withdraw
        $withdraw = TutorWithdrawals::create([
            'tutor_id' => $id,
            'description' => request('description'),
            'amount' => request('amount'),
            'fee' => request('fee'),
            'transaction_id' => request('transaction_id'),
            'payment_method' => ucfirst(request('payment_method'))
        ]);
        $tutor = User::where('id', $id)->with('profile')->first();
        //send email to tutor to informing the of the withdrawal
        //Check if amount is greater than 0
        if (request('amount') > 0 && strtolower(request('payment_method')) === 'paypal') {
            Mail::to($tutor->email)->send(new TutorWithdrawal($tutor, $withdraw));
        }
        if ($withdraw) {
            return redirect()->route('admin.scholarprofile', $id)->with('status', 'Withdrawal success');
        }
    }

    public function payments($id) {
        $tutor = User::where('id', $id)->get();
        if ($tutor->isEmpty()) {
            return redirect()->route('admin.tutors')->with('error', 'User does not exist');
        }
        $tutor = User::where('id', $id)->first();
        $payments = TutorPayments::where('tutor_id', $tutor->id)->latest()->paginate(100);
        $withdrawals = TutorWithdrawals::where('tutor_id', $tutor->id)->latest()->paginate(100);
        return view('admin.payments.tutor.index', compact('tutor', 'payments', 'withdrawals'));
    }
}
