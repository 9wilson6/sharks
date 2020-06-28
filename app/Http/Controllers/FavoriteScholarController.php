<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders;
use App\FavoriteScholar;
use Illuminate\Support\Facades\Auth;

class FavoriteScholarController extends Controller
{
    public function totalorders($tutor_id, $student_id)
    {
       $total = Orders::where('student_id', $student_id)->where('tutor_id', $tutor_id)->count();
       return $total;
    }

    public function index() {
    	$scholars = FavoriteScholar::where('student_id', Auth::user()->id)->get();
        return view('student.account.favorite_scholars', compact('scholars'));
    }

    public function add($tutor) {
    	$scholars = FavoriteScholar::create([
                'tutor_id' => $tutor,
                'student_id' => Auth::user()->id
            ]);
        return redirect()->back()->with('status', 'You have added a favorite tutor <a href="/account/favorite-scholars">View favorite tutors</a>');
    }

    public function isfavorite($tutor)
    {
    	$favorite = FavoriteScholar::where('tutor_id', $tutor)->where('student_id', Auth::user()->id)->count();
    	if ($favorite < 1) {
    		return true;
    	}
    }

}
