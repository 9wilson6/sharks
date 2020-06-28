<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $this->call(SettingTableSeeder::class);

        return true;
        return;



        $this->call('RolesTableSeeder');
        $this->call(SubjectTableSeeder::class);
        $this->call(SettingTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        return true;


        //create students
        factory(App\UserProfileController::class, 3)->create([
            'skills' => 'student',
        ]);
        //create tutors
        factory(App\UserProfileController::class, 3)->create([
            'skills' => 'tutor',
        ]);        
        //Create order and place a bid for every tutor
        factory(App\Orders::class, 20)->create()->each(function ($order) {
            $masterfaker = Faker\Factory::create();
            $tutor = App\User::role('tutor')->orderByRaw("RAND()")->first();
            $placebid = App\Bids::create([
                'order_id' => $order->id,
                'tutor_id' => $tutor->id,
                'amount' => $this->calculatebidamount($order->budget)
            ]);
            if ($placebid) {
                $updateorder = App\Orders::find($placebid->order_id);
                $updateorder->status = 4;
                $updateorder->agreed_amount = $placebid->amount;
                $updateorder->tutor_id = $placebid->tutor_id;
                $updateorder->date_awarded = $masterfaker->dateTimeBetween($placebid->created_at, '+1 days');
                $updateorder->save();
                
                if ($updateorder) {
                    $uploadsolution = App\Orders::find($updateorder->id);
                    $uploadsolution->status = 5;
                    $uploadsolution->date_completed = $masterfaker->dateTimeBetween($updateorder->date_awarded, '+20 days');
                    $uploadsolution->save();

                    if ($uploadsolution) {
                        $releasepayment = App\Orders::find($uploadsolution->id);
                        $releasepayment->status = 6;
                        $releasepayment->save();

                        $amount = 0.43 * $releasepayment->agreed_amount;
                        $fee = 0.57 * $releasepayment->agreed_amount;
                        $tutorpayment = App\TutorPayments::create([
                            'tutor_id' => $releasepayment->tutor->id,
                            'order_id' => $releasepayment->id,
                            'amount' => $amount,
                            'fee' => $fee,
                            'description' => 'Payment for order #'.$releasepayment->id
                        ]);
                        $notification = App\Notifications::create([
                            'user_id' => $releasepayment->tutor->id,
                            'description' => 'Student has released payment for order #'.$releasepayment->id
                        ]);
                        if ($releasepayment) {
                            //Add rating to order
                            $thetutor = App\User::where('id', $releasepayment->tutor_id)->first();
                            $rating = new \muyaedward\Rateable\Rating;
                            $rating->rating = 10;
                            $rating->comments = $masterfaker->realText(50);
                            $rating->recommend = 'Yes';
                            $rating->user_id = $releasepayment->student_id;
                            $rating->order_id =$releasepayment->id;
                            $thetutor->ratings()->save($rating);
                        }
                    }
                }
            }            
        });
    }


    private function calculatebidamount($budget){
        $faker = Faker\Factory::create();
        switch ($budget) {
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
        return $calculated_budget;
    }
}
