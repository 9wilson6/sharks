<?php

use App\User;
use Illuminate\Support\Str;
use App\UserProfileController; 
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run() {
        $admin = User::create([
            'name' => 'Administrator',
    		'email' => 'josephwanjara@gmail.com',
    		'password' => bcrypt('secret'),
            'fullname' => 'Administrator',
            'remember_token' => Str::random(10),
    		'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s')
        ]);
        if ($admin) {
            $adminprofile = UserProfileController::create([
                'user_id' => $admin->id
            ]);
        }
        $admin->assignRole('superadmin');
    }
}
