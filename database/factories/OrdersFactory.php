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
$factory->define(App\Orders::class, function (Faker $faker) {
    $student_id = App\User::orderByRaw('RAND()')->role('student')->first();
    return [
        'subject' => $faker->randomElement(['Art', 'Business', 'English', 'Computer', 'Foregn Language', 'History', 'Law', 'Mathematics', 'Medicine', 'Philosophy', 'Science', 'General']),
        'title' => $faker->realText(30),
        'homedate' => $faker->dateTimeBetween('+0 days', '+4 days'),
        'numpages' => $faker->numberBetween($min = 1, $max = 20),
        'format' => $faker->randomElement(['APA', 'MLA', 'CHICAGO', 'HAVARD', 'OTHERS']),
        'budget' => $faker->randomElement(['$5-$10', '$10-$30', '$30-$100', '$100-$250', '$250-$500', '$500-$1000']),
        'level' => $faker->randomElement(['High School', 'Undergraduate level 1-2', 'Undergraduate level 3-4', 'Masters level', 'PHD level']),
        'description' => $faker->sentence,
        'status' => 1,
        'student_id' => $student_id['id']
    ];
});