<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        return view('settings.index');
    }

    public function updatemain(Request $request){
        $setting = Setting::find(1);
        $setting->update([
            'sitename' => request('sitename'),
            'siteemail' => request('siteemail')
        ]);
        if ($setting) {
            return redirect()->back();
        }
    }

    public function updatetelegram(Request $request){
        $setting = Setting::find(1);
        $setting->update([
            'enabletelegram' => request('enabletelegram'),
            'telegramchatid' => request('telegramchatid')
        ]);
        if ($setting) {
            return redirect()->back();
        }
    }

    public function updatebidding(Request $request){
        $setting = Setting::find(1);
        $setting->update([
            'release_grace' => request('release_grace')
        ]);
        if ($setting) {
            return redirect()->back();
        }
    }

    public function updatecommissions(Request $request){
        $setting = Setting::find(1);
        $setting->update([
            'levelone' => request('levelone'),
            'leveltwo' => request('leveltwo'),
            'levelthree' => request('levelthree'),
            'levelfour' => request('levelfour')
        ]);
        if ($setting) {
            return redirect()->back();
        }
    }
}
