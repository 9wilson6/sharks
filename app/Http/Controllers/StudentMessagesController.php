<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\User;
use Carbon\Carbon;
use App\Mail\MessageToAdmin;
use App\Mail\Autoresponse;
use App\Mail\MessageToUser;
use Illuminate\Support\Facades\Mail;
use Muyaedward\Messenger\Models\Message;
use Muyaedward\Messenger\Models\Participant;
use Muyaedward\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;

class StudentMessagesController extends Controller
{    
    public function index() {
         $threads = Thread::forUser(Auth::id())->latest('updated_at')->paginate(20);
        return view('student.messenger.index', compact('threads'));
    }

    public function show($id) {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');
            return redirect()->route('student.messages');
        }
        $users = User::whereNotIn('id', $thread->participantsUserIds(Auth::user()->id))->get();
        $thread->markAsRead(Auth::user()->id);
        return view('student.messenger.show', compact('thread', 'users'));
    }

    public function create($id) {
        if (is_numeric($id)) {
            $user = User::where('id', $id)->first();
            if ($user->profile->verified === null) {
                abort(403, 'You are not allowed to send message to this user');
            }
            if ($user->hasRole('student')) {
                abort(403, 'You are not allowed to send message to this user');
            }
            return view('student.messenger.create', compact('user'));
        } else {
            if ($id === 'support') {
                return view('student.messenger.adminsend');
            }
            abort(403, 'We could not find the user, try again');
        }                       
    }

    public function supportstore(Request $request) {        
        $thread = Thread::create([ 'subject' => request('subject')]);
        $file = $request->file('message_file');
        if($request->hasFile('message_file')) {
            $cleanedfilename = clean_filename($file->getClientOriginalName());
            $message = Message::create([
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => request('message'),
                'filename'      => $cleanedfilename
            ]);
            $file->storeAs('messages/'.$thread->id.'/'.$message->id, $cleanedfilename);
        } else {
            $message = Message::create([
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => request('message')
            ]);
        }
        // Sender
        Participant::create([
            'thread_id' => $thread->id,
            'user_id'   => Auth::user()->id,
            'last_read' => new Carbon,
        ]);
        // Send to all admin users and super admin
        $users = User::role(['admin', 'superadmin'])->get();
        if ($users->isEmpty()) {
            abort(403, 'No recipient specified');
        }
        $resp = [];
        foreach ($users as $user) {
            $resp[] = $user->id;
            Mail::to($user->email)->send(new MessageToUser(Auth::user()));
        }
        $thread->addParticipant($resp);
        return redirect()->route('student.messages');
    }

    public function store(Request $request, $id) {        
        $thread = Thread::create([ 'subject' => request('subject')]);
        $file = $request->file('message_file');
        if($request->hasFile('message_file')) {
            $cleanedfilename = clean_filename($file->getClientOriginalName());
            $message = Message::create([
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => request('message'),
                'filename'      => $cleanedfilename
            ]);
            $file->storeAs('messages/'.$thread->id.'/'.$message->id, $cleanedfilename);
        } else {
            $message = Message::create([
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => request('message')
            ]);
        }
        // Sender
        Participant::create([
            'thread_id' => $thread->id,
            'user_id'   => Auth::user()->id,
            'last_read' => new Carbon,
        ]);
        // Recipients
        $thread->addParticipant([$id]);
        //send email to recipient
        $sendto = User::where('id', $id)->first();
        Mail::to($sendto['email'])->send(new MessageToUser(Auth::user()));
        return redirect()->route('student.messages');
    }

    public function download_message_upload($thread_id, $message_id, $file_name) {
      $file_path = storage_path('app/messages/'.$thread_id.'/'.$message_id.'/'.$file_name);
      return response()->download($file_path);
    }

    public function update(Request $request, $id) {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');
            return redirect()->route('student.messages');
        }
        $thread->activateAllParticipants();

        $file = $request->file('message_file');
        if($request->hasFile('message_file')) {
            $cleanedfilename = clean_filename($file->getClientOriginalName());
            $message = Message::create([
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => request('message'),
                'filename'      => $cleanedfilename
            ]);
            $file->storeAs('messages/'.$thread->id.'/'.$message->id, $cleanedfilename);
        } else {
            $message = Message::create([
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => request('message')
            ]);
        }
        // Add replier as a participant
        $participant = Participant::firstOrCreate([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
        ]);
        $participant->last_read = new Carbon;
        $participant->save();
        foreach ($thread->participants as $part) {
            if ($participant->user_id != $part->user_id) {
                $theuser = User::where('id', $part->user_id)->first();
                Mail::to($theuser->email)->send(new MessageToUser($theuser));
            }
        }
        return redirect()->route('student.messages.show', $id);
    }

}
