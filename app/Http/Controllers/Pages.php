<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subjects;

class Pages extends Controller
{
    public function index() {
        $subjects = Subjects::get();
        return view('pages.index', compact('subjects'));
    }

    public function becomeatutor() {
        return view('tutor.register.index');
    }
    
    public function tos() {
       return view('pages.tos');
    }

    public function privacy_policy() {
        return view('pages.privacy');
    }

    public function contact() {
       return view('pages.contact');
    }

    public function plagiarism_free_guarantee() {
        return view('pages.plagiarism');
    }

    public function refund_policy() {
        return view('pages.refund');
    }

    public function revision_policy() {
        return view('pages.revision');
    }
}