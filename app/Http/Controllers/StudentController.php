<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Orders;
use App\Subjects;
use App\OrderPayments;
use Illuminate\Http\Request;
use App\Mail\ChangedPassword;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
    public function index() {
        $disputed = Orders::latest()->with('bids')->where('status', 3)->where('student_id', Auth::user()->id)->paginate(20);
        $orders = Orders::latest()->with('bids')->whereIn('status', array(1, 4, 5, 6, 8))->where('student_id', Auth::user()->id)->paginate(20);
        return view('student.home.index', compact('disputed', 'orders'));
    }
    public function changepass() {
        return view('student.account.changepass');
    }

    public function edit() {
        return view('student.account.edit-profile');
    }

    public function updateprofile(Request $request) {
        $rules = [
            'name' => 'required|unique:users,name,'. Auth::user()->id .'',
            'email' => 'required|email|max:255|unique:users,email,'. Auth::user()->id .'',
            'fullname' => 'required'
		];
		$customMessages = [
            'name.unique' => 'That Username already in use by another User',
            'email.unique' => 'That Email already is used by another User',
            'fullname.required' => 'Your name is required',
            'email.required' => 'Email address is required',
            'email.email' => 'Email address provided is invalid'
        ];
        $this->validate($request, $rules, $customMessages);
        $user = User::find(Auth::user()->id);
        $user->update([
            'name' => request('name'),
            'email' => request('email'),
            'fullname' => request('fullname')
        ]);
        if ($user) {
            return redirect()->route('student.profile')->with('status', 'Your account has been updated successfully');
        }
    }

    public function updatepassword(Request $request) {
        $user = User::find(Auth::user()->id);
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

    public function profile() {
        return view('student.account.studentprofile');
    }

    public function scholaronline() {
        $scholars = User::role('tutor')->get();
        foreach ($scholars as $tutor) {
            $tutor->tutorratings = $tutor->ratings->count();
            $tutor->tutorlevel = $this->acelevel($tutor->id);
        }
        return view('student.account.scholaronline', compact('scholars'));
    }

    public function scholarprofile($id) {
        $userdetails = User::where('id', $id)->first();
        $subjects = Subjects::get();
        $reviews = $userdetails->ratings()->orderBy('id', 'DESC')->paginate(20);
        $tutoraverage_review = $userdetails->averageRating();
        $tutor_reviews = $userdetails->ratings->count();
        $acelevel = $this->acelevel($id);
        return view('student.account.scholarprofile', compact('userdetails', 'acelevel', 'subjects', 'reviews', 'tutoraverage_review', 'tutor_reviews'));
    }

    private function acelevel($id){
        $userdetails = User::where('id', $id)->first();
        $tutoraverage_review = $userdetails->averageRating();
        $tutor_reviews = $userdetails->ratings->count();
        if ($tutor_reviews <= 5) {
            $userlevel = 'Level 1';
        }
        if ($tutor_reviews > 5 && $tutor_reviews <= 25) {
            $userlevel = 'Level 2';
        }
        if ($tutor_reviews > 25 && $tutor_reviews <= 100 && $tutoraverage_review < 9.3) {
            $userlevel = 'Level 2';
        }
        if ($tutor_reviews > 25 && $tutor_reviews <= 100 && $tutoraverage_review > 9.3) {
            $userlevel = 'Level 3';
        }
        if ($tutor_reviews > 100 && $tutoraverage_review < 9.7) {
            $userlevel = 'Level 4';
        }
        if ($tutor_reviews > 100 && $tutoraverage_review > 9.7) {
            $userlevel = 'Level 4';
        }
        return $userlevel;
    }
}
