<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Orders;
use App\Payments;
use App\Subjects;
use App\Notifications;
use App\UserAttachments;
use Illuminate\Support\Str;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use App\Mail\ProfileChanged;
use App\Mail\ChangedPassword;
use App\UserProfileController;
use Illuminate\Support\Facades\Mail;

class TutorController extends Controller
{
    use UploadTrait;

    public function index() {
        $disputed = Orders::latest()->where('status', 3)->where('tutor_id', Auth::user()->id)->paginate(20);
        $notifications = Notifications::latest()->where('user_id', Auth::user()->id)->limit(5)->get();
        $orders = Orders::latest()->whereIn('status', array(1, 4, 5, 6, 8))->where('tutor_id', Auth::user()->id)->paginate(20);
        return view('tutor.home.index', compact('disputed', 'orders', 'notifications'));
    }

    public function amountyouget($amount){
        return response()->json([
            'amount' => $amount - getamountbylevel(Auth::user(), $amount)
        ], 200);
    }

    public function changepass() {
        return view('tutor.account.changepass');
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
        $subjects = Subjects::get();
        return view('tutor.account.index', compact('subjects'));
    }

    public function student_profile($id) {
        $student = User::where('id', $id)->first();
        $posted = Orders::where('student_id', $id)->count();
        $awarded = Orders::where('student_id', $id)->whereNotNull('tutor_id')->count();
        $disputed = Orders::where('student_id', $id)->where('status', 3)->count();
        $refunded = Orders::where('student_id', $id)->where('status', 7)->count();
        $reviews = $student->ratings()->orderBy('id', 'DESC')->paginate(20);
        return view('tutor.account.studentprofile', compact('posted', 'awarded', 'disputed', 'refunded', 'reviews'));
    }

    public function scholarprofile() {
        $userdetails = User::where('id', Auth::user()->id)->first();
        $subjects = Subjects::get();
        $reviews = Auth::user()->ratings()->orderBy('id', 'DESC')->paginate(20);
        $tutoraverage_review = Auth::user()->averageRating();
        $tutor_reviews = Auth::user()->ratings->count();
        $acelevel = getacelevel(Auth::user());
        return view('tutor.account.scholarprofile', compact('userdetails', 'acelevel', 'subjects', 'reviews', 'tutoraverage_review', 'tutor_reviews'));
    }


    public function editprofile() {
        $useraccount = User::where('id', Auth::user()->id)->first();
        $subjects = Subjects::get();
        $ischecked = true;
        return view('tutor.account.editprofile', compact('useraccount', 'subjects', 'ischecked'));
    }

    public function edit(Request $request) {        
        // Form validation
        $request->validate([
            'about_me' => 'required',
            'skills' => 'required',
            'highest_level' => 'required',
            'major' => 'required',
            'avatar'     =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $userupdate = User::findOrFail(Auth::user()->id);
        // Check if a profile image has been uploaded
        if ($request->has('avatar')) {
            // Get image file
            $image = $request->file('avatar');
            
            // Make a image name based on user name and current timestamp
            $name = Str::slug(Auth::user()->name).'_'.time();
                        
            // Define folder path
            $folder = '/uploads/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'profileupload', $name);
            // Set user profile image path in database to filePath
            $userupdate->avatar = $filePath;
        }
        $userupdate->save();

        $userprof = UserProfileController::where('user_id', Auth::user()->id)->first();
        $user = UserProfileController::findOrFail($userprof->id);
        // Persist user record to database
        $user->about_me = request('about_me');
        $user->payment_method = request('payment_method');
        $user->skills = request('skills');
        $user->highest_level = request('highest_level');
        $user->major = request('major');
        $user->save();
        //Notify user that account has been updated
        Mail::to(Auth::user()->email)->send(new ProfileChanged());
        if ($user) {
            return redirect()->route('tutor.profile')->with('status', 'Profile updated successfully');
        }        
    }

    public function subscriptions() {
        return view('tutor.account.subscriptions');
    }

    public function upgrade_subscription() {
        return view('tutor.account.upgradesubscription');
    }

    public function mybookmarks() {
        return view('tutor.account.mybookmarks');
    }

    public function scholarhelp() {
        return view('tutor.account.scholarhelp');
    }
}
