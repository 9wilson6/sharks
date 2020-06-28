<?php

if (! function_exists('clean_filename')) {
    function clean_filename($string) {
        $string = str_replace(' ', '', $string);
        return preg_replace('/[^A-Za-z0-9\-.]/', '', $string);
    }
}


if (! function_exists('getacelevel')) {
    function getacelevel($userdetails) {
        $average = $userdetails->averageRating();
        $reviews = $userdetails->ratings->count();
        if ($reviews <= 5) {
           return 'Level 1';
        }
        if ($reviews > 5 && $reviews <= 25) {
           return 'Level 2';
        }
        if ($reviews > 25 && $reviews <= 100 && $average < 9.3) {
           return 'Level 2';
        }
        if ($reviews > 25 && $reviews <= 100 && $average > 9.3) {
           return 'Level 3';
        }
        if ($reviews > 100 && $average < 9.7) {
           return 'Level 4';
        }
        if ($reviews > 100 && $average > 9.7) {
            return 'Level 4';
        }
    }
}


if (! function_exists('getamountbylevel')) {
    function getamountbylevel($userdetails, $amount) {
        switch (getacelevel($userdetails)) {
            case 'Level 1':
                $fee = 0.65 * $amount;
                break;
            case 'Level 2':
                $fee = 0.60 * $amount;
                break;
            case 'Level 3':
                $fee = 0.55 * $amount;
                break;
            case 'Level 4':
                $fee = 0.45 * $amount;
                break;
            default:
                $fee = 0.65 * $amount;
                break;
        }
        return $fee;
    }
}


if (! function_exists('tutorefunds')) {
    function tutorefunds($tutorid) {
        $tutor = App\User::where('id', $tutorid)->get();
        if ($tutor->isEmpty()) {
            return [];
        }
        $tutor = App\User::where('id', $tutorid)->first();
        if ($tutor->orderawards->isEmpty()) {
            return [];
        }
        $refunds = [];
        foreach ($tutor->orderawards as $order) {
            if ($order->refund != null) {
                $refundsthe = $order->refund->where('created_at', '>', \Carbon\Carbon::now()->subDays(30))->first();
                if ($refundsthe != null) {
                    $refunds[] = $refundsthe;
                }
            }
        }
        return [];
    }
}
