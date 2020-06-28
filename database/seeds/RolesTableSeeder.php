<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $superadmin = Role::create(['name' => 'superadmin']);
        $admin = Role::create(['name' => 'admin']);
        $tutor = Role::create(['name' => 'tutor']);
        $student = Role::create(['name' => 'student']);
    }
}
