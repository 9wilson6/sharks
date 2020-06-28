<?php

namespace App\Http\Controllers;

use App\Mail\FirstEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PromotionsController extends Controller
{
    public function testemail() {
        $mail = Mail::to('muyaedward@gmail.com')->send(new FirstEmail());
        dd($mail);
    }

    public function sendemailfirst() {
        //Loop through all emails and send email
        $emails = storage_path('app/emails/remain.txt');
        $contents = file($emails);
        foreach($contents as $line) {
            $this->startemail($line);
        }
        dd('Done sending');
    }

    private function startemail($themail) {
        $emailarray = explode(':', $themail);
        $email = [
            'id' => $emailarray[0],
            'to' => preg_replace('/\s+/', '', $emailarray[1]),
            'count' => preg_replace('/\s+/', '', $emailarray[2])            
        ];
        $when = now()->addSeconds(10);
        Mail::to($email['to'])->later($when, new FirstEmail());
    }

    private function startemail_multiple($themail) {
        $emailarray = explode(':', $themail);
        $email = [
            'sendto' => preg_replace('/\s+/', '', $emailarray[0]),
            'fromsender' => preg_replace('/\s+/', '', $emailarray[1]),
            'fromname' => trim($emailarray[3]),
            'password' => preg_replace('/\s+/', '', $emailarray[2])
        ];
        config([
            'mail.driver' => 'smtp',
            'mail.host' => 'smtp.mail.yahoo.com',
            'mail.port' => 587,
            'mail.from' => [
                'address' => $email['fromsender'],
                'name' => $email['fromname']
            ],
            'mail.reply_to' => [
                'address' => 'support@homeworkbubble.com',
                'name' => 'Homework Bubble'
            ],
            'mail.encryption' => 'tls',
            'mail.username' => $email['fromsender'],
            'mail.password' => $email['password']
        ]);
        //dd(config('mail'));
        Mail::to($email['sendto'])->send(new FirstEmail());
        //dump($send);
    }
}
