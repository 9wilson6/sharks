<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use League\HTMLToMarkdown\HtmlConverter;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;
use Illuminate\Notifications\Messages\SlackMessage;

class NewEmail extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $inbound;
    protected $converter;


    public function __construct($inbound) {
        $this->inbound = $inbound;
        $this->converter = new HtmlConverter();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) {
        return [TelegramChannel::class, 'slack'];
    }
    
    public function toTelegram($notifiable) {
        $themail = $this->converter->convert($this->inbound);
        // $themail->Subject();
        // $themail->FromEmail();
        // $themail->FromFull();
        // $themail->FromName();
        // $themail->Date();
        // $themail->OriginalRecipient();
        // $themail->ReplyTo();
        // $themail->MailboxHash();
        // $themail->Tag();
        // $themail->MessageID();
        // $themail->TextBody();
        // $themail->HtmlBody();
        // $themail->StrippedTextReply();
        return TelegramMessage::create()
            ->to(420729193)            
            ->content("Hello there!\nYou got email from *{$themail->FromEmail()}* to *{$themail->OriginalRecipient()}* with subject \n*{$themail->Subject()}* \nBelow is the email")
            ->content($themail->HtmlBody());
    }

    public function toSlack($notifiable) {
        $themail = $this->converter->convert($this->inbound);
        return (new SlackMessage)
            ->content("Hello there!\nYou got email from *{$themail->FromEmail()}* to *{$themail->OriginalRecipient()}* with subject \n*{$themail->Subject()}* \nBelow is the email")
            ->content($themail->HtmlBody());
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
