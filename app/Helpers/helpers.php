<?php

if (! function_exists('clean_filename')) {
    function clean_filename($string) {
        $string = str_replace(' ', '', $string);
        return preg_replace('/[^A-Za-z0-9\-.]/', '', $string);
    }
}

if (! function_exists('defaultsettings')) {
    function defaultsettings() {
        $dsetting = \App\Setting::where('id', 1)->first();
        return [
            'enabletelegram' => $dsetting->enabletelegram,
            'telegram_level' => $dsetting->telegram_notify_level,
            'telegramchatid' => $dsetting->telegramchatid,
            'sitename' => $dsetting->sitename,
            'siteurl'  => $dsetting->siteurl,
            'siteemail' => $dsetting->siteemail,
            'release_grace' => $dsetting->release_grace,
            'levelone' => $dsetting->levelone,
            'leveltwo' => $dsetting->leveltwo,
            'levelthree' => $dsetting->levelthree,
            'levelfour' => $dsetting->levelfour
        ];
    }
}

if (! function_exists('sidebaritem')) {
    function sidebaritem() {
        return [
            'calculator',
            'testimonials',
            'features'
        ];
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
           return 'Level 3';
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
                $fee = (defaultsettings()['levelone']/100) * $amount;
                break;
            case 'Level 2':
                $fee = (defaultsettings()['leveltwo']/100) * $amount;
                break;
            case 'Level 3':
                $fee = (defaultsettings()['levelthree']/100) * $amount;
                break;
            case 'Level 4':
                $fee = (defaultsettings()['levelfour']/100) * $amount;
                break;
            default:
                $fee = (defaultsettings()['levelone']/100) * $amount;
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
