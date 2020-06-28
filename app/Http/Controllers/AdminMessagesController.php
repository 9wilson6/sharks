<?php

namespace App\Http\Controllers;

use Storage;
use App\User;
use Carbon\Carbon;
use App\Mail\Autoresponse;
use App\Mail\MessageToUser;
use App\Mail\MessageToAdmin;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Muyaedward\Messenger\Models\Message;
use Muyaedward\Messenger\Models\Participant;
use Muyaedward\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class AdminMessagesController extends Controller {

    public function index() {
        //Implement caching and pagination
         $threads = Thread::forUser(Auth::id())->latest('updated_at')->paginate(20);
        return view('admin.messenger.index', compact('threads'));
    }

    public function all() {
         $threads = Thread::getAllLatest()->latest('updated_at')->paginate(20);
        return view('admin.messenger.index', compact('threads'));
    }

    public function show($id) {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');
            return redirect()->route('admin.messages');
        }
        $users = User::whereNotIn('id', $thread->participantsUserIds(Auth::user()->id))->get();
        $thread->markAsRead(Auth::user()->id);
        return view('admin.messenger.show', compact('thread', 'users'));
    }

    public function create($id) {
        $user = User::where('id', $id)->first();
        return view('admin.messenger.create', compact('user'));
    }

    public function sendmessageto($id) {
        $user = '';
        if ($id === 'students') {
            $user = 'students';
        }
        if ($id === 'tutors') {
            $user = 'tutors';
        }
        if ($user === '') {
            abort(403, 'You are not allowed to perform this action');
        }
        return view('admin.messenger.sendmessageto', compact('user'));
    }

    public function storegroup(Request $request, $group) {        
        if ($group === 'students') {
            $students = User::role('student')->get();
            foreach ($students as $student) {
                $messagedata = [
                    'subject' => request('subject'),
                    'files' => $request->file('message_file'),
                    'message' => request('message'),
                    'userid' => $student->id
                ];
                $this->sendtomany($messagedata);
            }
            return redirect()->route('admin.messages')->with('status', 'Message has been queued and will be sent to all students');
        }else {
            $tutors = User::role('tutor')->get();
            foreach ($tutors as $tutor) {
                $messagedata = [
                    'subject' => request('subject'),
                    'files' => $request->file('message_file'),
                    'message' => request('message'),
                    'userid' => $tutor->id
                ];
                $this->sendtomany($messagedata);
            }
            return redirect()->route('admin.messages')->with('status', 'Message has been queued and will be sent to all tutors');
        }
        
    }

    public function sendtomany(array $messagedata) {        
        $thread = Thread::create([ 'subject' => $messagedata['subject']]);
        $file = $messagedata['files'];
        if($file) {
            $cleanedfilename = clean_filename($file->getClientOriginalName());
            $message = Message::create([
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => $messagedata['message'],
                'filename'      => $cleanedfilename
            ]);
            $file->storeAs('messages/'.$thread->id.'/'.$message->id, $cleanedfilename);
        } else {
            $message = Message::create([
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => $messagedata['message']
            ]);
        }
        // Sender
        Participant::create([
            'thread_id' => $thread->id,
            'user_id'   => Auth::user()->id,
            'last_read' => new Carbon,
        ]);
        // Recipients
        $thread->addParticipant([$messagedata['userid']]);
        $sendto = User::where('id', $messagedata['userid'])->first();
        Mail::to($sendto->email)->send(new MessageToUser(Auth::user()));
        return redirect()->route('admin.messages');
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
        $sendto = User::where('id', $id)->first();
        Mail::to($sendto['email'])->send(new MessageToUser(Auth::user()));
        return redirect()->route('admin.messages');
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
            return redirect()->route('admin.messages');
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
        return redirect()->route('admin.messages.show', $id);
    }
}