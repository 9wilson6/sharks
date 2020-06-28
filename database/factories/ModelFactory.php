<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

//Factory to generate tutor accounts

/* $factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    $payment_email = $faker->unique()->safeEmail;
    $role = 'student';

    if ($role == 'student') {
    	return [
	        'name' => $faker->name,
	        'email' => $faker->unique()->safeEmail,
	        'password' => $password ?: $password = bcrypt('secret'),
	        'role' => $role
        ];
    } else {
    	return [
	        'name' => $faker->name,
	        'email' => $payment_email,
	        'password' => $password ?: $password = bcrypt('secret'),
	        'role' => $role,
	        'email_me' => $faker->randomElement([0, 1]),
	        'skills' => $faker->randomElement(['Problem Solving', 'Adaptability', 'Collaboration', 'Strong Work Ethic', 'Time Management', 'Critical Thinking', 'Self-Confidence', 'Handling Pressure', 'Leadership', 'Creativity']),
	        'highest_level' => $faker->randomElement(['Diploma', 'PHD', 'Masters', 'Degree']),
	        'major' => $faker->randomElement(['Diploma', 'PHD', 'Masters', 'Degree']),
	        'tutor_balance' => $faker->randomFloat(1, 20, 50),
	        'level' => 1,
	        'verified' => $faker->randomElement([0, 1]),
	        'membership' => 1,
	        'payment_email' => $payment_email,
	        'about_me' => $faker->paragraph(random_int(4, 7))
        ];
    }    
}); */

/* $factory->define(App\Orders::class, function (Faker\Generator $faker) {
	$studentid = App\User::orderByRaw('RAND()')->where('role', 'student')->first();
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
        'student_id' => $studentid['id']
    ];
}); */

/*Bids factory*/

/* $factory->define(App\Bids::class, function (Faker\Generator $faker) {
	$order = App\Orders::orderByRaw('RAND()')->where('status', 1)->first();	
	$tutor = App\User::orderByRaw('RAND()')->where('role', 'tutor')->first();

	switch ($order['budget']) {
		case '$5-$10':
			$calculated_budget = $faker->randomFloat(2, 5, 10);
			break;
		case '$10-$30':
			$calculated_budget = $faker->randomFloat(2, 10, 30);
			break;
		case '$30-$100':
			$calculated_budget = $faker->randomFloat(2, 30, 100);
			break;
		case '$100-$250':
			$calculated_budget = $faker->randomFloat(2, 100, 250);
			break;
		case '$250-$500':
			$calculated_budget = $faker->randomFloat(2, 250, 500);
			break;
		case '$500-$1000':
			$calculated_budget = $faker->randomFloat(2, 500, 1000);
			break;
	}

	$homedate = $faker->dateTimeBetween($order['homedate'], '+5 days');
    return [        
        'order_id' => $order['id'],
        'tutor' => $tutor['name'],
        'tutor_id' => $tutor['id'],
        'student_id' => $order['student_id'],
        'amount' => $calculated_budget,
        'homedate' => $homedate
    ];
}); */