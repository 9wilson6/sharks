<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\StudentPayments;
use App\Mail\SignupEmail;
use Illuminate\Http\Request;
use App\Mail\TutorSignupEmail;
use App\UserProfileController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/welcome';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'fullname' => 'required|max:50',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'fullname' => $data['fullname'],
            'password' => Hash::make($data['password'])
        ]);
        //Add the user profile
        if ($user) {
            $studentprofile = UserProfileController::create([
                'user_id' => $user->id
            ]);
            //Add $10 as bonus
            // $studentpayment = StudentPayments::create([
            //     'student_id' => $user->id,
            //     'amount' => 10,
            //     'description' => 'Registration coupon',
            //     'payment_method' => 'coupon',
            //     'transaction_id' => 'COUPON-REG-'.$user->id
            // ]);
        }
        //Add role
        $user->assignRole('student');
        Mail::to($user->email)->send(new SignupEmail($user, request('password')));
        return $user;
    }

    public function register_tutor(Request $request) {
        return 'Registration not allowed';
        $rules = [
            'name'      => 'required|alpha_dash|max:20|unique:users,name',
            'email'     => 'required|email|unique:users,email',
            'fullname' => 'required|max:50',
            'password'  => 'required|min:6',
            'password_confirmation' => 'required|same:password'
		];
		$customMessages = [
            'name.required' => 'Username is required',
            'name.alpha_dash' => 'Username should not have spaces',
            'name.max' => 'Username should not be more than 20 characters',
            'name.unique' => 'That user name already exist in our database',
            'fullname.required' => 'Your full name is required',
            'email.required' => 'Your email is required',
            'email.email' => 'Please provide a valid email address',
            'email.unique' => 'That email address already exist in our database',
            'password.required' => 'Your password is required',
            'password.min' => 'Password should be more than 5 characters',
            'password_confirmation.required' => 'Your confirm password is required',
            'password_confirmation.same' => 'Your passwords do not match'
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
            Mail::to($user->email)->send(new TutorSignupEmail($user, request('password')));
            Auth::login($user);
            return redirect()->route('tutorhome')->with('status', 'Your account was created successfully');
        } catch (\Exception $e) {
            abort(502, $e->getMessage());
        }
    }
}