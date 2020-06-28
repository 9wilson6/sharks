<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function tutorbalanceget($id){
        $users = User::role('tutor')->where('id', $id)->get();
        if ($users->isEmpty()) {
            return response()->json([
                'error' => 'Somothing wrong happenend'
            ], 400);
        }

        $balance = 0;

        return response()->json([
            'balance' => $balance
        ], 200);
    }
}
