<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\UserAttachments;
use Illuminate\Http\Request;
class UserAttachmentsController extends Controller
{
    public function upload(Request $request) {
        if (Auth::user()->hasRole('tutor')) {
            $files = $request->file('attachments');
            if($request->hasFile('attachments')) {
                foreach ($files as $file) {
                    $cleanedfilename = clean_filename($file->getClientOriginalName());
                    $userattachments = UserAttachments::create([
                        'user_id' => Auth::user()->id,
                        'filename' => $cleanedfilename
                    ]);
                    $file->storeAs('user/attachments/'.Auth::user()->id, $cleanedfilename);                
                }
            }
            return redirect()->route('tutor.profile')->with('status', 'Documents added successfully');
        }
        return redirect()->route('tutor.profile')->with('error', 'You are not allowed to perform this action');
    }

    public function download($id) {
        $attachment = UserAttachments::where('user_id', Auth::user()->id)->where('id', $id)->get();
        if ($attachment->isEmpty()) {
            return redirect()->route('tutor.profile')->with('error', 'You are not allowed to perform this action');
        }
        $attach = UserAttachments::where('id', $id)->first();
        $file_path = storage_path('app/user/attachments/'.Auth::user()->id.'/'.$attach->filename);
        return response()->download($file_path);
    }

    public function delete($id) {
        $attachment = UserAttachments::where('user_id', Auth::user()->id)->where('id', $id)->get();
        if ($attachment->isEmpty()) {
            return redirect()->route('tutor.profile')->with('error', 'You are not allowed to perform this action');
        }
        $attach = UserAttachments::find($id);
        $attach->delete();
        return redirect()->route('tutor.profile')->with('status', 'Documents deleted successfully');        
    }
}