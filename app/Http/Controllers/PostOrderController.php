<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use App\Orders;
use App\Subjects;
use Carbon\Carbon;
use App\StudentPayments;
use App\Mail\SignupEmail;
use Illuminate\Http\Request;
use App\UserProfileController;
use Illuminate\Support\Facades\Mail;
use AfricasTalking\SDK\AfricasTalking;
use infobip\api\client\SendSingleTextualSms;
use infobip\api\configuration\BasicAuthConfiguration;
use infobip\api\model\sms\mt\send\textual\SMSTextualRequest;

class PostOrderController extends Controller
{
    protected $AT;

    public function __construct() {
        $at_username = 'kikuyu1';
        $at_apikey 	= 'e4491bbf19dae9677f35454482d1156cbad43a0252af221ea4d321b26d284791';
        $this->AT = new AfricasTalking($at_username, $at_apikey);
    }

    public function postproject() {      
        $subjects = Subjects::get(); 
        return view('projects.post', compact('subjects'));
    }

    public function save(Request $request) {
        $order_from_homepage = [
            'subject' => request('subject'),
            'title' => request('title'),
            'budget' => request('budget'),
            'email' => request('email')
        ];
        Session::put('fromhome', $order_from_homepage);
        //If user exist in the database
        $user = User::where('email', request('email'))->get();
        if ($user->isEmpty()) {
            //Signup and redirect to post page
            if ($this->signsupclient($order_from_homepage)) {
                return redirect()->route('projects.post');
            }
        } else {
            return redirect()->route('projects.post');
        }
    }

    public function save_project_order(Request $request) {
        $rules = [
            'numpages' => 'required|numeric',
            'budget' => 'required',
            'format' => 'required',
            'level' => 'required',
            'subject' => 'required',
            'title' => 'required',
            'description' => 'required'
		];
		$customMessages = [];
        
        $this->validate($request, $rules, $customMessages);
        //Add Order
        if (Carbon::parse(request('homedate'))->isPast() || request('homedate') == null) {
            $orderdate = Carbon::now()->addDays(2);
        }else {
            $orderdate = Carbon::parse(request('homedate'));
        }

        $order = Orders::create([
            'subject' => request('subject'),
            'title' => request('title'),
            'homedate' => $orderdate,
            'level' => request('level'),
            'numpages' => request('numpages'),
            'format' => request('format'),
            'budget' => request('budget'),
            'description' => request('description'),
            'student_id' => Auth::user()->id
        ]);
        if ($order) {
            return redirect()->route('student.order.details', $order->id)->with('status', 'Order has been added successfully');
        }
    }


    private function signsupclient($order){
        $username = $this->generateusername(5);
        $userpassword = $this->generateRandomnumber(5);
        $user = User::create([
            'name' => $username,
            'email' => $order['email'],
            'password' => bcrypt($userpassword),
        ]);
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
        Mail::to($user->email)->send(new SignupEmail($user, $userpassword));
        if (Auth::attempt(['email' => $user->email, 'password' => $userpassword])) {
            return true;
        }
    }


    private function generateusername(){
        $isavailable = true;
        while ($isavailable) {
            $generated = $this->generateRandomnumber(7);
            $available = User::where('name', 'student-'.$generated)->count();
            if ($available == 0) {
                $username = 'student-'.$generated;                
                $isavailable = false;
                return $username;
            } else {
                $isavailable = true;
            }            
        }
    }

    private function generateRandomnumber($length) {
        $result = '';
        for($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 5);
        }
        return $result;
    }

    public function checkifexists(Request $request) {
        $rules = [
			'emailaddress' => 'required|email'
		];
		$customMessages = [
            'emailaddress.required' => 'Email address is required',
            'emailaddress.email' => 'Email provided is not valid'
        ];
        $this->validate($request, $rules, $customMessages);
        try {
            $user = User::where('email', request('emailaddress'))->get();
            if ($user->isEmpty()) {
                return response()->json([
                    'action' => 'signup'
                ]);
            } else {
                return response()->json([
                    'action' => 'login'
                ]);
            }
        }
        catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'message' => [$e->getMessage()]
                ]
            ], 422);
        }
    }

    public function index(Request $request) {
        $orderdetails = request('orderdetails');
        $rules = [
            'orderdetails.numpages' => 'required|numeric',
            'orderdetails.budget' => 'required',
            //'orderdetails.deadline' => 'required',
            'orderdetails.emailaddress' => 'required|email',
            'orderdetails.format' => 'required',
            'orderdetails.level' => 'required',
            'orderdetails.orderdetails' => 'required',
            'orderdetails.subject' => 'required',
            'orderdetails.title' => 'required'
		];
		$customMessages = [
            'orderdetails.emailaddress.required' => 'Email address is required',
            'orderdetails.emailaddress.email' => 'Email address is invalid'
        ];
        $this->validate($request, $rules, $customMessages);
        if (!Auth::user()->hasRole('student')) {
            Auth::logout();
            return response()->json([
                'errors' => [
                    0 => ['You are not allowed to post homework. Try with a different email']
                    ]
            ], 422);
        }else{
            try {
                if (empty($orderdetails['subject']) || $orderdetails['deadline'] === null) {
                    $orderdate = Carbon::parse(now())->timezone('UTC');
                }else {
                    $orderdate = Carbon::parse($orderdetails['deadline'])->timezone('UTC');
                }
                $order = Orders::create([
                    'subject' => $orderdetails['subject'],
                    'title' => $orderdetails['title'],
                    'homedate' => $orderdate,
                    'level' => $orderdetails['level'],
                    'numpages' => $orderdetails['numpages'],
                    'format' => $orderdetails['format'],
                    'budget' => $orderdetails['budget'],
                    'description' => $orderdetails['orderdetails'],
                    'student_id' => Auth::user()->id
                ]);
                //$messageat = $this->sendparcel_mesage_AT($order->id);
                //$messageinfobip = $this->sendparcel_mesage_INFOBIP($order->id);
                if ($order) {
                    return response()->json([
                        'link' => 'home/order-details/'.$order->id,
                        'order' => $order
                    ], 200);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'errors' => [
                        0 => [$e->getMessage()]
                        ]
                ], 422);
            }            
        }
    }

    public function login(Request $request) {
        $orderdetails = request('orderdetails');
        $rules = [
            'password' => 'required',
            'orderdetails.numpages' => 'required|numeric',
            'orderdetails.budget' => 'required',
            //'orderdetails.deadline' => 'required',
            'orderdetails.emailaddress' => 'required|email',
            'orderdetails.format' => 'required',
            'orderdetails.level' => 'required',
            'orderdetails.orderdetails' => 'required',
            'orderdetails.subject' => 'required',
            'orderdetails.title' => 'required'
		];
		$customMessages = [
            'password.required' => 'Password is required',
            'orderdetails.emailaddress.required' => 'Email address is required',
            'orderdetails.emailaddress.email' => 'Email address is invalid'
        ];
        $this->validate($request, $rules, $customMessages);
        //validate inputs
        //Check if details provided are valid and that the user is a student
        if (Auth::attempt(['email' => $orderdetails['emailaddress'], 'password' => request('password')])) {
            if (!Auth::user()->hasRole('student')) {
                Auth::logout();
                return response()->json([
                    'errors' => [
                        0 => ['You are not allowed to post homework. Try with a different email']
                        ]
                ], 422);
            }
			try {
                if (empty($orderdetails['subject']) || $orderdetails['deadline'] === null) {
                    $orderdate = Carbon::parse(now())->timezone('UTC');
                }else {
                    $orderdate = Carbon::parse($orderdetails['deadline'])->timezone('UTC');
                }
                $order = Orders::create([
                    'subject' => $orderdetails['subject'],
                    'title' => $orderdetails['title'],
                    'homedate' => $orderdate,
                    'level' => $orderdetails['level'],
                    'numpages' => $orderdetails['numpages'],
                    'format' => $orderdetails['format'],
                    'budget' => $orderdetails['budget'],
                    'description' => $orderdetails['orderdetails'],
                    'student_id' => Auth::user()->id
                ]);
                //$messageat = $this->sendparcel_mesage_AT($order->id);
                //$messageinfobip = $this->sendparcel_mesage_INFOBIP($order->id);
                if ($order) {
                    return response()->json([
                        'link' => 'home/order-details/'.$order->id,
                        'order' => $order
                    ], 200);
                }
			} catch (\Exception $e) {
				return response()->json([
					'errors' => [
						0 => [$e->getMessage()]
						]
				], 422);
			}
		}else{			
			return response()->json([
				'errors' => [
					0 => ['Invalid username or password']
					]
			], 422);
		}
        //If not valid, return with error
        //If valid post order with id as the owner of the order
        //return the order number
    }

    public function register(Request $request) {
        $orderdetails = request('orderdetails');
        $rules = [
            'password' => 'required|confirmed:password',
            'fullname' => 'required',
            'username' => 'required|unique:users',
            'orderdetails.numpages' => 'required|numeric',
            'orderdetails.budget' => 'required',
            //'orderdetails.deadline' => 'required',
            'orderdetails.emailaddress' => 'required|email|unique:users',
            'orderdetails.format' => 'required',
            'orderdetails.level' => 'required',
            'orderdetails.orderdetails' => 'required',
            'orderdetails.subject' => 'required',
            'orderdetails.title' => 'required'
		];
		$customMessages = [
            'password.required' => 'Password is required',
            'orderdetails.emailaddress.required' => 'Email address is required',
            'orderdetails.emailaddress.email' => 'Email address is invalid',
            'orderdetails.emailaddress.unique' => 'Email address is already in use',
            'orderdetails.username' => 'That username is already in use'
        ];
        $this->validate($request, $rules, $customMessages);
        try {
            //Register user and log user in
            $user = User::create([
                'name' => request('username'),
                'email' => $orderdetails['emailaddress'],
                'password' => bcrypt(request('password')),
                'fullname' => request('fullname')
            ]);
            //Add the user profile
            if ($user) {
                $studentprofile = UserProfileController::create([
                    'user_id' => $user->id
                ]);
                //Add $10 as bonus
                $studentpayment = StudentPayments::create([
                    'student_id' => $user->id,
                    'amount' => 10,
                    'description' => 'Registration coupon',
                    'payment_method' => 'coupon',
                    'transaction_id' => 'COUPON-REG-'.$user->id
                ]);
            }        
            //Add role
            $user->assignRole('student');

            Mail::to($user->email)->send(new SignupEmail($user, request('password')));
            Auth::login($user);
            if ($user) {
                //Add Order
                if (empty($orderdetails['subject']) || $orderdetails['deadline'] === null) {
                    $orderdate = Carbon::parse(now())->timezone('UTC');
                }else {
                    $orderdate = Carbon::parse($orderdetails['deadline'])->timezone('UTC');
                }
                $order = Orders::create([
                    'subject' => $orderdetails['subject'],
                    'title' => $orderdetails['title'],
                    'homedate' => $orderdate,
                    'level' => $orderdetails['level'],
                    'numpages' => $orderdetails['numpages'],
                    'format' => $orderdetails['format'],
                    'budget' => $orderdetails['budget'],
                    'description' => $orderdetails['orderdetails'],
                    'student_id' => $user->id
                ]);
                //$messageat = $this->sendparcel_mesage_AT($order->id);
                //$messageinfobip = $this->sendparcel_mesage_INFOBIP($order->id);
                if ($order) {
                    return response()->json([
                        'link' => 'home/order-details/'.$order->id,
                        'order' => $order
                    ], 200);
                }
            }            
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    0 => [$e->getMessage()]
                    ]
            ], 422);
        }        
    }

    public function sendparcel_mesage_AT($order){
        $orderdetails = Orders::where('id', $order)->with('student')->first();
        try {
            $SMS = $this->AT->sms();
            $message = 'Client '.$orderdetails->student->name.' placed a new order due on '.$orderdetails->homedate. 'with budget '.$orderdetails->budget;
            $options = array(
                'to' => ['254702681502'],
                'from' => 'OVERSEAS',
                'message' => $message
            );
            $SMS->send($options);
            return [
                'status' => 'success',
                'message' => $message
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Error message: '. $e->getMessage()
            ];
        }
    }

    public function sendparcel_mesage_INFOBIP($order){
        $orderdetails = Orders::where('id', $order)->with('student')->first();
        try {
            $message = 'Client '.$orderdetails->student->name.' placed a new order due on '.$orderdetails->homedate. 'with budget '.$orderdetails->budget;
            $client = new SendSingleTextualSms(new BasicAuthConfiguration('Overseascourier', '81400300'));
            $requestBody = new SMSTextualRequest();
            $requestBody->setFrom('OVERSEAS');
            $requestBody->setTo(['254702681502']);
            $requestBody->setText($message);
            try {
                $response = $client->execute($requestBody);
                $sentMessageInfo = $response->getMessages()[0];
                return [
                    'status' => 'success',
                    'message' => $message
                ];
            } catch (\Exception $exception) {
                return [
                    'status' => 'error',
                    'message' => 'HTTP status code: '. $exception->getCode().', Error message: '. $exception->getMessage()
                ];
            }            
        } catch (\Exception $e) {
                return [
                    'status' => 'error',
                    'message' => 'Error message: '. $e->getMessage()
                ];            
        }        
    }
}