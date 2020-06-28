<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Bids;
use App\User;
use App\Pusher;
use App\Orders;
use Carbon\Carbon;
use App\Notifications;
use App\Events\BidsUpdated;
use Illuminate\Http\Request;
use App\Mail\ProfileChanged;
use App\Mail\ChangedPassword;
use App\Events\AdminBidsUpdated;
use App\Events\TutorBidsUpdated;
use App\Events\TutorOrdersUpdated;
use App\Events\StudentOrdersUpdated;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller {

    public function clearall(){
        $this->clearbootstrap();
        $this->clearlogs();
        $this->clearcache();
        $this->clearsessions();
        $this->clearviews();
        return redirect()->route('admin.orders')->with('status', 'All data cleared and all account signed out');
    }

    public function loginAs() {
        //get the id from the post
        $id = request('user_id');
        //if session exists remove it and return login to original user
        if (session()->get('hasClonedUser') == 1) {
            auth()->loginUsingId(session()->remove('hasClonedUser'));
            session()->remove('hasClonedUser');
            return redirect()->route('welcome');
        }

        //only run for developer, clone selected user and create a cloned session
        if (auth()->user()->hasRole('superadmin')) {
            session()->put('hasClonedUser', auth()->user()->id);
            auth()->loginUsingId($id);
            return redirect()->route('welcome');
        }
    }

    public function pusher(){
        $pushers = \App\Pusher::get();
        dd($pushers);        
    }
    
    public function editpusher(){
        $pushers = \App\Pusher::where('id', 1)->get();
        if ($pushers->isEmpty()) {
            $push = [
                'app_id' => '891706',                
                'app_key' => 'e6fcc07a0947cc5fdaa8',
                'app_secret' => '8750339239aa3eac7c6f',
                'app_cluster' => 'ap2'
            ];
        } else {
            $pusher = \App\Pusher::where('id', 1)->first();
            $push = [
                'app_id' => $pusher->app_id,
                'app_key' => $pusher->app_key,
                'app_secret' => $pusher->app_secret,
                'app_cluster' => $pusher->app_cluster
            ];
        }
        return view('admin.account.editpusher', compact('push'));
    }

    public function savepusher(Request $request) {
        $savepusher = Pusher::updateOrCreate(
            ['id' => 1],
            [
                'app_id' => request('app_id'),
                'app_key' => request('app_key'),
                'app_secret' => request('app_secret'),
                'app_cluster' => request('app_cluster')
            ]
        );
        // $env = new DotenvEditor();
        // $env->changeEnv([
        //     'PUSHER_APP_ID'   => $savepusher->app_id,
        //     'PUSHER_APP_KEY'   => $savepusher->app_key,
        //     'PUSHER_APP_SECRET'   => $savepusher->app_secret,
        //     'PUSHER_APP_CLUSTER'   => $savepusher->app_cluster
        // ]);
        if ($savepusher) {
            return redirect()->route('admin.editpusher')->with('status', 'Pusher data has been updated successfully');
        }        
    }

    public function clearbootstrap(){
        $filesToDelete = array_filter(glob(base_path('/bootstrap/cache/*')), function($file) {
            return false === strpos($file, '.gitignore');
        });
        foreach ($filesToDelete as $file) {
            unlink($file);
        }
    }

    public function clearlogs(){
        $filesToDelete = array_filter(glob(base_path('/storage/logs/*')), function($file) {
            return false === strpos($file, '.gitignore');
        });
        foreach ($filesToDelete as $file) {
            unlink($file);
        }
    }

    public function clearcache(){
        $directories = \File::directories(base_path('storage/framework/cache/data'));        
        foreach ($directories as $directory) {
            \File::deleteDirectory($directory);
        }
    }

    public function clearsessions(){
        $filesToDelete = array_filter(glob(base_path('/storage/framework/sessions/*')), function($file) {
            return false === strpos($file, '.gitignore');
        });
        foreach ($filesToDelete as $file) {
            unlink($file);
        }
    }

    public function clearviews(){
        $filesToDelete = array_filter(glob(base_path('/storage/framework/views/*')), function($file) {
            return false === strpos($file, '.gitignore');
        });
        foreach ($filesToDelete as $file) {
            unlink($file);
        }
    }

    public function index() {
        $orders = Orders::latest()->paginate(20);
        return view('admin.orders', compact('orders'));
    }

    public function getstudents() {
        \Illuminate\Pagination\Paginator::currentPageResolver(function ($pageName = 'page') {
			return (int) ($_GET[$pageName] ?? 1);
        });
        if (!empty($_GET['search_by'])) {
            switch ($_GET['search_by']) {
                case 'email':
                    return  User::role('student')->where('email', 'like', '%' . $_GET['email'] . '%')->with('profile')->latest()->paginate(15);
                
                case 'name':
                    return  User::role('student')->where('name', 'like', '%' . $_GET['name'] . '%')->with('profile')->latest()->paginate(15);
            }
        } else {
            return User::role('student')->with('profile')->latest()->paginate(15);
        }
        
    }
    

    public function gettutors() {
        \Illuminate\Pagination\Paginator::currentPageResolver(function ($pageName = 'page') {
			return (int) ($_GET[$pageName] ?? 1);
        });
        if (!empty($_GET['search_by'])) {
            switch ($_GET['search_by']) {
                case 'email':
                    return  User::role('tutor')->where('email', 'like', '%' . $_GET['email'] . '%')->with('profile')->latest()->paginate(15);
                
                case 'name':
                    return  User::role('tutor')->where('name', 'like', '%' . $_GET['name'] . '%')->with('profile')->latest()->paginate(15);

                case 'fullname':
                    return  User::role('tutor')->where('fullname', 'like', '%' . $_GET['fullname'] . '%')->with('profile')->latest()->paginate(15);

                case 'verified':
                     $verified = $_GET['verified'];
                     if ($verified == 'verified') {
                        return User::role('tutor')->with(['profile' => function ($query) {
                            $query->where('verified', 1);
                        }])->whereHas('profile', function ($query) {
                            $query->where('verified', 1);
                        })->paginate(10);
                    } elseif ($verified == 'notverified') {
                        return User::role('tutor')->with(['profile' => function ($query) {
                            $query->where('verified', null);
                        }])->whereHas('profile', function ($query) {
                            $query->where('verified', null);
                        })->paginate(10);
                    }
            }
        } else {
            return User::role('tutor')->with('profile')->latest()->paginate(15);
        }
        
    }

    public function getorders() {
        \Illuminate\Pagination\Paginator::currentPageResolver(function ($pageName = 'page') {
			return (int) ($_GET[$pageName] ?? 1);
        });

        if (!empty($_GET['search_by'])) {
            switch ($_GET['search_by']) {
                case 'subject':
                     return  Orders::latest()->where('subject', $_GET['subject'])->with(['bids', 'tutor'])->paginate(20);
                     
                case 'budget':
                     return  Orders::latest()->where('budget', $_GET['budget'])->with(['bids', 'tutor'])->paginate(20);
                     
                case 'status':
                     return  Orders::latest()->where('status', $_GET['status'])->with(['bids', 'tutor'])->paginate(20);
                     
                case 'title':
                     return  Orders::latest()->where('title', 'like', '%' . $_GET['title'] . '%')->with(['bids', 'tutor'])->paginate(20);
                     
                case 'createdat':
		 		    $createdat =  $_GET['createdat'];
		 		    return Orders::latest()->whereDate('created_at', '=', Carbon::parse($createdat)->format('Y-m-d'))->with(['bids', 'tutor'])->paginate(20);
		             
                case 'awardedto':
		 		    $tutorusername = $_GET['awardedto'];
		 			return Orders::latest()->with(['bids', 'tutor' => function ($query) use($tutorusername) {
		 				$query->where('name', 'like', '%' . $tutorusername . '%');
		 			}])->whereHas('tutor', function ($query) use($tutorusername) {
		 			    $query->where('name', 'like', '%' . $tutorusername . '%');
                    })->paginate(10);			
		 		default:
		 			return Orders::latest()->with(['bids', 'tutor'])->paginate(20);
            }
        } else {
            return Orders::latest()->with(['bids', 'tutor'])->paginate(20);
        }

        
        
        //We are searching
		// if (!empty($_GET['search_by']) && !empty($_GET['filter'])) {
		// 	switch ($_GET['search_by']) {
		// 		case 'subject':
		// 			$bookings = BookingsModel::latest()->where('ticket_number', 'like', '%' . $_GET['filter'] . '%')->with('seat', 'arrival', 'departure', 'user', 'tour', 'tour.route', 'payments.user')->paginate(10);
		//             $this->output->set_content_type('application/json')->set_output(json_encode($bookings));
		// 			break;
		// 		case 'budget':
		// 			$bookings = BookingsModel::latest()->where('name', 'like', '%' . $_GET['filter'] . '%')->with('seat', 'arrival', 'departure', 'user', 'tour', 'tour.route', 'payments.user')->paginate(10);
		//             $this->output->set_content_type('application/json')->set_output(json_encode($bookings));
		// 			break;
		// 		case 'awardedto':
		// 			$departure = $_GET['filter'];					
		// 			$departure_bookings = BookingsModel::latest()->with(['seat', 'tour', 'arrival', 'user', 'tour.route', 'payments.user', 'departure' => function ($query) use($departure) {
		// 				$query->where('name', 'like', '%' . $departure . '%');
		// 			}])->whereHas('departure', function ($query) use($departure) {
		// 			    $query->where('name', 'like', '%' . $departure . '%');
		// 			})->paginate(10);
		//             $this->output->set_content_type('application/json')->set_output(json_encode($departure_bookings));
					
		// 		case 'status':
		// 			$arrival = $_GET['filter'];
		// 			$arrival_bookings = BookingsModel::latest()->with(['seat', 'tour', 'departure', 'user', 'tour.route', 'payments.user', 'arrival' => function ($query) use($arrival) {
		// 				$query->where('name', 'like', '%' . $arrival . '%');
		// 			}])->whereHas('arrival', function ($query) use($arrival) {
		// 			    $query->where('name', 'like', '%' . $arrival . '%');
		// 			})->paginate(10);
		//             $this->output->set_content_type('application/json')->set_output(json_encode($arrival_bookings));					
		// 			break;
		// 		case 'createdat':
		// 		    $booking_date =  $_GET['filter'];
		// 		    $bookings = BookingsModel::latest()->whereDate('created_at', '=', Carbon::parse($booking_date)->format('Y-m-d'))->with('seat', 'arrival', 'departure', 'user', 'tour', 'tour.route', 'payments.user')->paginate(10);
		//             $this->output->set_content_type('application/json')->set_output(json_encode($bookings));
		// 			break;
										
		// 			break;
		// 		case 'booked_by':
		// 		    $user_firstname = $_GET['filter'];
		// 			$clerk_booked_by = BookingsModel::latest()->with(['seat', 'tour', 'departure', 'arrival', 'tour.route', 'payments.user', 'user' => function ($query) use($user_firstname) {
		// 				$query->where('first_name', 'like', '%' . $user_firstname . '%');
		// 			}])->whereHas('user', function ($query) use($user_firstname) {
		// 			    $query->where('first_name', 'like', '%' . $user_firstname . '%');
		// 			})->paginate(10);
		//             $this->output->set_content_type('application/json')->set_output(json_encode($clerk_booked_by));					
		// 			break;					
		// 			break;				
		// 		default:
		// 			$bookings = BookingsModel::latest()->where('ticket_number', 'like', '%' . $_GET['filter'] . '%')->with('seat', 'arrival', 'departure', 'user', 'tour', 'tour.route', 'payments.user')->paginate(10);
		//             $this->output->set_content_type('application/json')->set_output(json_encode($bookings));
		// 			break;
		// 	}
			
		// } else {
		// 	$bookings = BookingsModel::latest()->with(['seat', 'arrival', 'departure', 'user', 'tour', 'tour.route', 'payments.user'])->paginate(10);
		//     $this->output->set_content_type('application/json')->set_output(json_encode($bookings));
		// }
    }

    public function redirectrole() {
        if (Auth::user()->hasRole('superadmin')) {
            return redirect()->route('admin.dashboard');
        }
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.orders');
        }

        if (Auth::user()->hasRole('tutor')) {
            return redirect()->route('tutorhome');
        }

        if (Auth::user()->hasRole('student')) {
            return redirect()->route('studenthome');
        }
    }

    public function changepass() {
        return view('admin.account.changepass');
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
        //Mail::to(Auth::user()->email)->send(new ProfileChanged());
        return redirect()->back()->with('status', 'Password changed successfully');
    }

    public function order($id) {
        $theorder = Orders::where('id', $id)->get();
        if ($theorder->isEmpty()) {
            abort(403, 'The order does not exist, may be it has been deleted');
        }
        $order_id = Orders::with('bids', 'tutor', 'ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
        return view('admin.orderdetails.index', compact('order_id'));
    }

    public function edit($id) {
        $order = Orders::where('id', $id)->first();
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, $id) {
        $order = Orders::find($id);
        $order->update([
            'subject' => request('subject'),
            'title' => request('title'),
            'homedate' => request('homedate'),
            'description' => request('description')
        ]);
        $broadcastorderstudent = Orders::with('ratings', 'tutor', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
        $broadcastorderstutor = Orders::with('bids', 'tutor', 'ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
        broadcast(new StudentOrdersUpdated($broadcastorderstudent))->toOthers();
        broadcast(new TutorOrdersUpdated($broadcastorderstutor))->toOthers();
        return redirect()->route('admin.order', $id)->with('status', 'Order was successfully updated');
    }

    public function deleteorder($id) {
        $order = Orders::where('id', $id)->first();
        $orderdelete = Orders::find($id);
        $orderdelete->delete();
        return redirect()->route('admin.orders')->with('status', 'Order was deleted successfully');
    }

    //Bids
    public function allbids() {
        $bids = Bids::latest()->with('order')->paginate(20);
        return view('admin.bids.index', compact('bids'));
    }

    public function bids($order) {
        $bids = Bids::latest()->where('order_id', $order)->with('order')->paginate(20);
        $order_no = $order;
        return view('admin.bids.index', compact('bids', 'order_no'));
    }

    //bids by tutor
    public function tutorbids($id) {
        $bids = Bids::latest()->where('tutor_id', $id)->with('order')->paginate(20);
        return view('admin.bids.index', compact('bids'));
    }

    public function adminbids($order_id) {
        $bids = Bids::latest()->where('order_id', $order_id)->with('tutor', 'order')->get();
        foreach ($bids as $bid) {
            $bid->tutorratings = $bid->tutor->ratings->count();
        }
        return $bids;
    }

    public function delete_bid($id){
        $bidder = Bids::where('id', $id)->first();
        $orderno = $bidder->order_id;
        //check if order is awarded
        $theorder = Orders::where('id', $orderno)->first();
        if ($theorder->status != 1) {
            return redirect()->route('admin.order', $orderno)->with('fail', 'You can not delete this bid because the order has already been assigned. Consider deleting/cancelling the order');
        }
        $bid = Bids::find($id);
        $bid->delete();
        broadcast(new TutorBidsUpdated($orderno))->toOthers();
        broadcast(new AdminBidsUpdated($orderno))->toOthers();
        broadcast(new BidsUpdated($orderno))->toOthers();
        return redirect()->route('admin.order', $orderno)->with('status', 'Your bid was deleted successfully');
    }
}
