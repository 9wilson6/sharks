<?php

namespace App\Console;

use App\Bids;
use App\User;
use App\Refund;
use App\Orders;
use Carbon\Carbon;
use App\DisputeOrders;
use App\Notifications;
use App\StudentPayments;
use App\TutorWithdrawals;
use App\Events\BidsUpdated;
use App\Mail\DisputeEscalated;
use App\UserProfileController;
use App\Mail\VerifyNotification;
use App\Events\TutorBidsUpdated;
use App\Mail\UnverifyNotification;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminVerifyNotification;
use App\Mail\AdminUnverifyNotification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) {
        //check for disputes and if they have escalated
        $schedule->call(function () {
            //get all disputed orders
            //$disputed_orders = DisputeOrders::where('created_at', '>', Carbon::now()->subHours(48))->with('order')->has()->get();
            $disputed_orders = DisputeOrders::where('created_at', '<', Carbon::now()->subHours(48))->whereHas('order', function($query) {
                $query->where('status', '!=', 6);
            })->with(['order' => function($query) {
                $query->where('status', '!=', 6);
            }])->get();
            //Mark all escalated orders as cancelled
            foreach ($disputed_orders as $order) {
                //Mark as closed and refund order
                $this->markasclosed($order->order_id);
            }
        })->everyTenMinutes();

        $schedule->call(function () {
            //Loop through all tutors
            $tutors = User::role('tutor')->get();
            foreach ($tutors as $tutor) {
                $totalrefunds = count(tutorefunds($tutor->id));
                //check if tutor has been suspended
                if (!$tutor->orders->isEmpty()) {
                    if($tutor->profile->verified === null){
                        if ($totalrefunds === 0) {
                            $this->verifytutor($tutor);
                        }
                    }else {
                        if ($totalrefunds >= 6) {
                            $this->unverifytutor($tutor);
                        }
                    }
                }
            }
        })->everyTenMinutes(); //Usually this will be done every day
    }

    private function unverifytutor($tutor) {
        $user = UserProfileController::where('user_id', $tutor->id)->first();
        $update = UserProfileController::find($user->id);
        $update->update([
            'verified' => null
        ]);
        $theadmin = User::where('id', 1)->first();
        if ($update) {
            Mail::to($tutor->email)->send(new UnverifyNotification($tutor));
            Mail::to($theadmin->email)->send(new AdminUnverifyNotification($tutor));
        }
    }
    private function verifytutor($tutor) {
        $user = UserProfileController::where('user_id', $tutor->id)->first();
        $update = UserProfileController::find($user->id);
        $update->update([
            'verified' => 1
        ]);
        $theadmin = User::where('id', 1)->first();
        if ($update) {
            Mail::to($tutor->email)->send(new VerifyNotification($tutor));
            Mail::to($theadmin->email)->send(new AdminVerifyNotification($tutor));
        }
    }


    private function calculatebidamount($budget){
        $faker = \Faker\Factory::create();
        switch ($budget) {
            case '$5-$10':
                $calculated_budget = $faker->randomFloat(2, 9, 30);
                break;
            case '$10-$30':
                $calculated_budget = $faker->randomFloat(2, 16, 40);
                break;
            case '$30-$100':
                $calculated_budget = $faker->randomFloat(2, 80, 150);
                break;
            case '$100-$250':
                $calculated_budget = $faker->randomFloat(2, 120, 350);
                break;
            case '$250-$500':
                $calculated_budget = $faker->randomFloat(2, 300, 700);
                break;
            case '$500-$1000':
                $calculated_budget = $faker->randomFloat(2, 600, 1000);
                break;
        }
        return $calculated_budget;
    }

    private function markasclosed($id) {
        $orderdetails = Orders::where('id', $id)->where('status', '!=', 6)->with('tutor', 'student', 'studentwithdrawals')->get();
        if ($orderdetails->isEmpty()) {
            return true;
        }
        $orderdetails = Orders::where('id', $id)->with('tutor', 'student', 'studentwithdrawals')->first();
        $notification = Notifications::create([
            'user_id' => $orderdetails->tutor->id,
            'description' => 'Dispute has escalated and order #'.$id.' refunded'
        ]);
        //Get all withdrawals of the client with this order
        foreach ($orderdetails->studentwithdrawals as $withdrawal) {
            $studentpayment = StudentPayments::create([
                'student_id' => $orderdetails->student->id,
                'amount' => $withdrawal->amount,
                'description' => 'Refund',
                'payment_method' => 'refund',
                'transaction_id' => 'REFUND-'.$id
            ]);
        }
        //Penalize the tutor
        //Withdraw
        $withdraw = TutorWithdrawals::create([
            'tutor_id' => $orderdetails->tutor->id,
            'description' => 'Escalation fee for a dispute to order #'.$id,
            'amount' => 25,
            'transaction_id' => 'ESCALATION-'.$id,
            'payment_method' => 'Penalty'
        ]);
        //Store the refund details
        $refund = Refund::create([
            'order_id' => $id,
            'description' => 'Escalation fee for a dispute to order #'.$id,
            'refund_agent' => $orderdetails->student->name,
            'refund_agent_id' => $orderdetails->student->id
        ]);

        $order = Orders::find($id);
        $order->update([
            'status' => 6,
        ]);
        if ($studentpayment) {
            $theadmin = User::where('id', 1)->first();
            Mail::to($orderdetails->student->email)->send(new DisputeEscalated($orderdetails, 'student'));
            Mail::to($orderdetails->tutor->email)->send(new DisputeEscalated($orderdetails, 'tutor'));
            Mail::to($theadmin->email)->send(new DisputeEscalated($orderdetails, 'admin'));
        }
        return true;
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
