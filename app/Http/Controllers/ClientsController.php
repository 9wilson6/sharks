<?php

namespace App\Http\Controllers;

use App\User;
use App\Orders;
use App\Subjects;
use App\StudentPayments;
use App\UserAttachments;
use Illuminate\Support\Str;
use App\StudentWithdrawals;
use App\Mail\UserResetPass;
use Illuminate\Http\Request;
use App\UserProfileController;
use App\Mail\ClientSignupEmail;
use App\Mail\UpgradeClientEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class ClientsController extends Controller {

    public function index() {
        $users = User::role('student')->latest()->paginate(15);
        return view('student.index', compact('users'));
    }

    public function create() {
        return view('student.add');
    }

    public function import() {
        return view('student.import');
    }

    public function importsave(Request $request){
        $array = Excel::toArray(new UsersImport, request()->file('studentfile'));
        foreach ($array[0] as $array) {
            if ($array['name'] != null && $array['email'] != null) {
                if ($this->checkifuseremailexists($array['email']) && $this->checkifusernameexists($array['name'])) {
                    $user = User::create([
                        'name' => $array['name'],
                        'email' => $array['email'],
                        'password' => bcrypt('secret'),
                        'fullname' => $array['name'],
                    ]);
                    if ($user) {
                        $clientprofile = UserProfileController::create([
                            'user_id' => $user->id
                        ]);
                    }
                    $user->assignRole('student');
                    //Add $5 as bonus
                    $studentpayment = StudentPayments::create([
                        'student_id' => $user->id,
                        'amount' => 5,
                        'description' => 'Registration coupon',
                        'payment_method' => 'coupon',
                        'transaction_id' => 'COUPON-REG-'.$user->id
                    ]);
                    Mail::to($user->email)->send(new UpgradeClientEmail($user));
                }
            }
        }
        return redirect()->route('admin.clients')->with('status', 'Students were imported successfully');
    }

    private function checkifuseremailexists($email){
        $user = User::where('email', $email)->get();
        if ($user->isEmpty()) {
            return true;
        } else {
            return false;
        }
    }

    private function checkifusernameexists($username){
        $user = User::where('name', $username)->get();
        if ($user->isEmpty()) {
            return true;
        } else {
            return false;
        }
    }

    public function download_sample() {
      $file_path = storage_path('app/demo.xlsx');
      return response()->download($file_path);
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
            'fullname.required' => 'Student full name is required',
            'name.required' => 'Student username is required',
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
            $user->assignRole('student');
            if (request('sendemail') != null) {
                Mail::to($user->email)->send(new ClientSignupEmail($user, request('password')));
            }
            return redirect()->route('admin.clients')->with('status', 'Client has been added successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function orders($id) {
        $student = User::where('id', $id)->first();
        $orders = Orders::where('student_id', $id)->with('bids', 'student')->paginate(50);
        return view('student.orders', compact('orders', 'student'));
    }

    public function edit($id) {
        $student = User::where('id', $id)->first();
        return view('student.edit', compact('student'));
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
            return redirect()->route('admin.clients')->with('status', 'Student has been updated successfully');
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
        return redirect()->route('admin.clients')->with('status', 'Password for user '.$user->email.' has been reset to '.$pass);
    }

    public function suspend($id){
        $user = User::where('id', $id)->get();
        if ($user->isEmpty()) {
            return redirect()->route('admin.clients')->with('error', 'User does not exist');
        }
        $theuser = User::find($id);
        $theuser->update([
            'status' => 0
        ]);
        if ($theuser) {
            return redirect()->route('admin.clients')->with('status', 'Student has been suspended successfully');
        }
    }

    public function unsuspend($id){
        $user = User::where('id', $id)->get();
        if ($user->isEmpty()) {
            return redirect()->route('admin.clients')->with('error', 'User does not exist');
        }
        $theuser = User::find($id);
        $theuser->update([
            'status' => 1
        ]);
        if ($theuser) {
            return redirect()->route('admin.clients')->with('status', 'Student has been unsuspended successfully');
        }
    }


    public function pass_change() {
        return view('student.passchange');
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
            return redirect()->route('admin.clients')->with('error', 'User does not exist');
        }
        $user = User::findOrFail($id);
        $user->fill([
            'password' => Hash::make(request('newpassword'))
        ])->save();
        return redirect()->route('admin.clients')->with('status', 'Password was updated successfully');
    }

    public function destroy($id) {
        $deleteuser = User::find($id);
        $deleteuser->delete();
        return redirect()->route('admin.clients')->with('status', 'User was deleted successfully');
    }

    public function studentprofile($id) {
        $userdetails = User::where('id', $id)->first();
        $reviews = $userdetails->ratings()->orderBy('id', 'DESC')->paginate(20);
        $posted = Orders::where('student_id', $id)->where('status', 1)->count();
        $awarded = Orders::where('student_id', $id)->where('status', 1)->count();
        $disputed = Orders::where('student_id', $id)->where('status', 1)->count();
        $refunded = Orders::where('student_id', $id)->where('status', 1)->count();
        $orders = [
            'posted' => $posted,
            'awarded' => $awarded,
            'disputed' => $disputed,
            'refunded' => $refunded
        ];
        return view('admin.account.studentprofile', compact('userdetails', 'reviews', 'orders'));
    }

    public function withdraw(Request $request, $id) {
        $rules = [
            'amount' => 'required|numeric',
            'description' => 'required',
            'transaction_id' => 'required'
		];
		$customMessages = [
            'amount.required' => 'Withdrawal amount is required',
            'amount.numeric' => 'Withdrawal amount provided is invalid, provide a numeric input',
            'description.required' => 'Withdrawal description is required',
            'transaction_id.required' => 'Transaction id is required'
        ];
        $this->validate($request, $rules, $customMessages);
        $student = User::where('id', $id)->get();
        if ($student->isEmpty()) {
            return redirect()->route('admin.clients')->with('error', 'User does not exist');
        }
        //Withdraw
        $withdraw = StudentWithdrawals::create([
            'student_id' => $id,
            'description' => request('description'),
            'amount' => request('amount'),
            'transaction_id' => request('transaction_id')
        ]);
        if ($withdraw) {
            return redirect()->route('admin.studentprofile', $id)->with('status', 'Withdrawal success');
        }
    }

    public function payments($id) {
        $student = User::where('id', $id)->get();
        if ($student->isEmpty()) {
            return redirect()->route('admin.clients')->with('error', 'User does not exist');
        }
        $student = User::where('id', $id)->first();
        $payments = StudentPayments::where('student_id', $student->id)->latest()->paginate(100);
        $withdrawals = StudentWithdrawals::where('student_id', $student->id)->latest()->paginate(100);
        return view('admin.payments.student.index', compact('student', 'payments', 'withdrawals'));
    }
}
