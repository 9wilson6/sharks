<?php

use App\Bids;
use App\Orders;
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.*', function ($user, $id) {
    return (int) $user->id === (int) $id;
}); 

Broadcast::channel('bids.{orderid}', function ($user, Orders $orderid) {
    return $user->id == $orderid->student_id;
});

Broadcast::channel('tutorbids.{orderid}', function ($user, Orders $orderid) {
    $bidder = Bids::where('tutor_id', $user->id)->where('order_id', $orderid->id)->get();
    return !$bidder->isEmpty();     
});

Broadcast::channel('adminbids.{orderid}', function ($user, Orders $orderid) {
    //$bidder = Bids::where('order_id', $orderid->id)->get();
    //return !$bidder->isEmpty() && $user->hasRole(['admin', 'superadmin']);
    return $user->hasRole(['admin', 'superadmin']);
});

//
Broadcast::channel('studentorder.{order}', function ($user, Orders $order) {
    return $user->id == $order->student_id;
});

//
Broadcast::channel('tutororder.{order}', function ($user, Orders $order) {
    $bidder = Bids::where('tutor_id', $user->id)->where('order_id', $order->id)->get();    
    return !$bidder->isEmpty() || $order->status == 1;
});


Broadcast::channel('adminorder.{order}', function ($user, Orders $order) {
    $theorder = Orders::where('id', $order->id)->get();
    return !$theorder->isEmpty() && $user->hasRole(['admin', 'superadmin']);
});