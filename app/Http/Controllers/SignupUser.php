<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\User;
use Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Mail\SignupEmail;
use App\Subjects;
use Session;

class SignupUser extends Controller
{

    public function getusername($id)
    {
        $users = User::where('id', $id)->first();
        return $users->name;
    }

    public function getuseremail($id)
    {
        $users = User::where('id', $id)->first();
        return $users->email;
    }


    public function postproject(Request $request)
    {
        $fromhome = [
            'subject' => request('subject'),
            'title' => request('title'),
            'budget' => request('budget'),
            'email' => request('email')
        ];
        Session::put('fromhome', $fromhome);
        $subjects = Subjects::get();
        //Session::forget('fromhome');

        if ($this->ifexistemail(request('email'))) {
            return redirect('/account/postproject');
        } else {
            $this->signsupclient(request('email'));
            return redirect('/account/postproject');
        }

    }

    private function ifexistemail($email){
        $user = User::where('email', $email)->count();
        if ($user > 0) {
            return true;
        }else{
            return false;
        }
    }
    
}