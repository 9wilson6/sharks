<?php

namespace App\Http\Controllers;

use Storage;
use App\User;
use Carbon\Carbon;
use App\Mail\Autoresponse;
use App\Mail\MessageToUser;
use App\Mail\MessageToAdmin;
use Illuminate\Http\Request;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Mail;
use Cmgmyr\Messenger\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Cmgmyr\Messenger\Models\Participant;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index()
    {
        // All threads, ignore deleted/archived participants
        //$threads = Thread::getAllLatest()->get();

        // All threads that user is participating in
         $threads = Thread::forUser(Auth::id())->latest('updated_at')->get();

        // All threads that user is participating in, with new messages
        // $threads = Thread::forUserWithNewMessages(Auth::id())->latest('updated_at')->get();

        return view('messenger.index', compact('threads'));
    }

    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');
            return redirect('messages');
        }

        // show current user in list if not a current participant
        // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();

        // don't show the current user in list
        $userId = Auth::user()->id;
        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

        $thread->markAsRead($userId);

        return view('messenger.show', compact('thread', 'users'));
    }

    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function create($id = null)
    {
        if ($id == null) {
            $admin = 'nothing';
            return view('messenger.create', compact('admin'));
        } else {
            if ($id == 'admin' || $id == 'administrator' || $id == 'support') {
               // $users = User::where('role', 'admin')->where('id', 1)->first();
                $users = User::where('id', 1)->first();
                $admin = 'yes';
                return view('messenger.create', compact('users', 'admin'));
            } else {
                $users = User::where('id', $id)->first();
                $admin = 'no';
                return view('messenger.create', compact('users', 'admin'));
            }
        }               
    }

    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        $webuser = [
          'username' => Auth::user()->name
        ];
        $input = $request->all();

        if ($input['autocompleted'] == 'yes') {
             $myuser = User::where('name', $input['recipients'])->first();                
             $homeworkuser = $myuser['id'];
        }else{
            $homeworkuser = $input['recipients'];
        }

        if ($homeworkuser === null) {
            return redirect('messages/create')->with('status', 'There is no such user');
        }
        if ($input['subject'] === null) {
            return redirect('messages/create')->with('status', 'You must include a subject');
        }

        if ($input['message'] === null) {
            return redirect('messages/create')->with('status', 'You must include a message');
        }

        if($homeworkuser == 1){
            Mail::to(Auth::user()->email)->send(new Autoresponse());
            Mail::to('support@homeworkbubble.com')->send(new MessageToAdmin());
        }else{
            $emailreceiver = User::where('id', $homeworkuser)->first(); 
            Mail::to($emailreceiver['email'])->send(new MessageToUser($webuser));
        }
        $thread = Thread::create(
            [
                'subject' => $input['subject'],
            ]
        );
        if (!empty($request->file('message_file'))) {
            $file = $request->file('message_file');
            $file_name = $file->getClientOriginalName();
            $file->storeAs('messages/'.$thread->id, $file_name);
            $keepm = $file_name;
        } else {
            $keepm = null;
        }        
        
        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => $input['message'],
                'filename'      => $keepm,
            ]
        );
        // Sender
        Participant::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'last_read' => new Carbon,
            ]
        );

        // Recipients
        if ($request->has('recipients')) {
            $thread->addParticipant($homeworkuser);
        }
        return redirect('messages');
    }

    public function getmessage($filename, $thread){
        $tempImage = tempnam(sys_get_temp_dir(), $filename);
        copy(Storage::temporaryUrl('messages/'.$thread.'/'.$filename, now()->addMinutes(5)), $tempImage);
        return response()->download($tempImage, $filename);
    }

    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        $file = $request->file('message_file');
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');
            return redirect('messages');
        }
        $thread->activateAllParticipants();
        /// send email to reply email

        /*if ($input['autocompleted'] == 'yes') {
             $myuser = User::where('name', $input['recipients'])->first();                
             $homeworkuser = $myuser['id'];
        }else{
            $homeworkuser = $input['recipients'];
        }

        if ($homeworkuser === null) {
            return redirect('messages/create')->with('status', 'There is no such user');
        }

        if($homeworkuser == 1){
            Mail::to(Auth::user()->email)->send(new Autoresponse());
            Mail::to('support@homeworkbubble.com')->send(new MessageToAdmin());
        }else{
            $emailreceiver = User::where('id', $homeworkuser)->first(); 
            Mail::to($emailreceiver['email'])->send(new MessageToUser($webuser));
        }*/
        ///  send email to reply email end

        if (!empty($file)) {
            //$ext = $file->guessClientExtension();
            $file_name = $file->getClientOriginalName();
            $file->storeAs('messages/'.$thread->id, $file_name);
            //$keepm = $file_name.'.'.$ext;
            $keepm = $file_name;
        } else {
            $keepm = null;
        }

        /*$emailreceiver = User::where('id', $homeworkuser)->first(); 
        Mail::to($emailreceiver['email'])->send(new MessageToUser($webuser));*/

        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::id(),
                'body'      => $request->get('message'),
                'filename'      => $keepm,
            ]
        );

        // Add replier as a participant
        $participant = Participant::firstOrCreate(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
            ]
        );
        $participant->last_read = new Carbon;
        $participant->save();

        // Recipients
        if ($request->has('recipients')) {
            $thread->addParticipant($request->get('recipients'));
        }

        return redirect('messages/' . $id);
    }
}

