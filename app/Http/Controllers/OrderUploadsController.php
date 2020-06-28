<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use App\Orders;
use Carbon\Carbon;
use App\OrderAttachments;
use Illuminate\Http\Request;
use App\Events\TutorOrdersUpdated;
use App\Events\StudentOrdersUpdated;
use Illuminate\Support\Facades\Auth;

class OrderUploadsController extends Controller
{
    public function upload($id) {
        $order_id = $id;
        return view('student.uploads.order.index', compact('order_id'));
    }

    public function adminupload($id) {
        $order_id = $id;
        return view('admin.uploads.order.index', compact('order_id'));
    }

    public function adminsaveupload(Request $request, $id){
        $rules = [];
        $customMessages = [];
        if($request->hasFile('upload_file')) {
            $files = count($request->file('upload_file')) - 1;
            foreach(range(0, $files) as $index) {
                $rules['upload_file.' . $index] = 'required|mimes:log,doc,docx,ppt,pptx,zip,7z,rar,txt,pdf,xls,xlsx,jpg,jpeg,png|max:20000';
                $customMessages['upload_file.' . $index . '.required'] = 'File upload is required';
                $customMessages['upload_file.' . $index . '.mimes'] = 'The uploaded file must be a file of type: png, jpeg, jpg, gif, log, txt.';
            }
            $this->validate($request, $rules, $customMessages);

            $files = $request->file('upload_file');

            foreach ($files as $file) {
                $cleanedfilename = clean_filename($file->getClientOriginalName());
                $orderuploads = OrderAttachments::create([
                    'order_id' => $id,
                    'original_filename' => $cleanedfilename,
                    'filename' => $cleanedfilename
                ]);
                $file->storeAs('order/attachments/'.$id, $cleanedfilename);
            }
            $broadcastorderstudent = Orders::with('ratings', 'tutor', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
            $broadcastorderstutor = Orders::with('bids', 'tutor', 'ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
            broadcast(new StudentOrdersUpdated($broadcastorderstudent))->toOthers();
            broadcast(new TutorOrdersUpdated($broadcastorderstutor))->toOthers();
            return redirect()->route('admin.order', $id)->with('status', 'File uploaded successfully');
        }
        return redirect()->route('admin.order', $id)->with('error', 'You did not provide data');
    }


	public function saveupload(Request $request, $id){
        if($request->hasFile('upload_file')) {
            $rules = [];
            $customMessages = [];
            $files = count($request->file('upload_file')) - 1;
            foreach(range(0, $files) as $index) {
                $rules['upload_file.' . $index] = 'required|mimes:log,doc,docx,ppt,pptx,zip,7z,rar,txt,pdf,xls,xlsx,jpg,jpeg,png|max:20000';
                $customMessages['upload_file.' . $index . '.required'] = 'File upload is required';
                $customMessages['upload_file.' . $index . '.mimes'] = 'The uploaded file must be a file of type: png, jpeg, jpg, gif, log, txt.';
            }
            $this->validate($request, $rules, $customMessages);
            $files = $request->file('upload_file');
            foreach ($files as $file) {
                $cleanedfilename = clean_filename($file->getClientOriginalName());
                $orderuploads = OrderAttachments::create([
                    'order_id' => $id,
                    'original_filename' => $cleanedfilename,
                    'filename' => $cleanedfilename
                ]);
                $file->storeAs('order/attachments/'.$id, $cleanedfilename);
            }
            $broadcastorderstudent = Orders::with('ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
            $broadcastorderstutor = Orders::with('bids', 'ratings', 'attachments', 'solutions', 'student', 'revisions', 'dispute')->where('id', $id)->first();
            broadcast(new StudentOrdersUpdated($broadcastorderstudent))->toOthers();
            broadcast(new TutorOrdersUpdated($broadcastorderstutor))->toOthers();
            return redirect()->route('student.order.details', $id)->with('status', 'File uploaded successfully');
        }
        return redirect()->route('student.order.details', $id)->with('error', 'You did not provide data');
    }

    public function download($id, $file_name) {
      $file_path = storage_path('app/order/attachments/'.$id.'/'.$file_name);
      return response()->download($file_path);
    }

    public function download_solution($id, $file_name) {
      $file_path = storage_path('app/order/solutions/'.$id.'/'.$file_name);
      return response()->download($file_path);
    }
}
