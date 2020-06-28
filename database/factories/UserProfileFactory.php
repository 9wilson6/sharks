<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\UserProfileController::class, function (Faker $faker) {
    return [
        'about_me' => $faker->userName,
        'skills' => $faker->userName,
        'highest_level' => $faker->userName,
        'major' => $faker->userName,
        'user_id' => function () {
            return  factory(App\User::class)->create()->assignRole('student')->id;
        }
    ];
});
