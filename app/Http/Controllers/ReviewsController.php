<?php

namespace App\Http\Controllers;

use App\User;
use App\Orders;
use App\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function getlatest(){
        $reviews = Review::where('publish', 1)->with('order.tutor')->get();
        foreach ($reviews as $key => $review) {
            $review->averagereview = number_format($review->order->tutor->averageRating(), 2);
            $review->completedorders = $review->order->tutor->orderawards->count();
        }
        return response()->json([
            'reviews' => $reviews
        ], 200);
    }

    public function edit(Request $request,$id) {
        $review = Review::find($id);
        $orders = Orders::where('id', $review->order_id)->get();
        if ($orders->isEmpty()) {
            return redirect()->back()->with('error', 'Order not found');
        }
        $review->update([
            'rating' => request('rating'),
            'comments' => request('comments'),
            'recommend' => request('recommend'),
            'publish' => request('publish') == '1' ? 1 : 0
        ]);
        if ($review) {
            return redirect()->back()->with('status', 'Tutor review has been edited successfully');
        }
    }
}