<?php

use App\User;
use App\Pusher;
use App\Setting;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'enabletelegram' => 1,
            'telegram_notify_level' => 0,
            'telegramchatid' => 33232,
            'sitename' => 'ExampleSite',
            'siteemail' => 'support@example.net',
            'siteurl' => 'https://studyace.net/',
            'release_grace' => 14,
            'levelone' => 65,
            'leveltwo' => 60,
            'levelthree' => 55,
            'levelfour' => 45
        ]);

        Pusher::create([
            'app_id' => '942793',
            'app_key' => '8979ccbf537975ba5c02',
            'app_secret' => '5e0b10213b23e45008e5',
            'app_cluster' => 'ap3'
        ]);

        $user = User::where('id', 1)->first();
        $user->removeRole('admin');
        $user->assignRole('superadmin');
    }
}
