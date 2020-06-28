<?php
namespace App\Notifications;

use App\User;
use App\Orders;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;

class Neworder extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     * https://hooks.slack.com/services/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
     *
     * @return void
     */
    
    protected $order;
    public function __construct(Orders $order) {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */

    public function via($notifiable) {
        // return [TelegramChannel::class, 'mail', 'slack'];
        return [TelegramChannel::class, 'mail', 'slack'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    public function toMail($notifiable) {
        return (new MailMessage)->view('emails.back.neworderplaced', ['order' => $this->order])
                                ->subject('New order placed from Homework Bubble');
    }

    public function toTelegram($notifiable) {
        return TelegramMessage::create()
            ->to(420729193)
            ->content("**Dear Admin**
            This is to inform you that a new order has neen placed
            Below are the details
            - Order Number: {$this->order->id}
            - Order Title: USD {$this->order->title}
            - Order Level: {$this->order->level}
            - Order Subject: {$this->order->subject}
            - Order Budget: {$this->order->budget}
            - Order Format: {$this->order->format}
            - Order Number of pages: {$this->order->numpages}
            Best regards,
            Homework Bubble Support Team") // Markdown supported.
            ->button('View Order', route('admin.order', $this->order->id)); // Inline Button
    }

    /**
     * Get the Slack representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return SlackMessage
     */
    public function toSlack($notifiable) {
        return (new SlackMessage)
                    ->content("**Dear Admin**
                    This is to inform you that a new order has neen placed
                    Below are the details
                    - Order Number: {$this->order->id}
                    - Order Title: USD {$this->order->title}
                    - Order Level: {$this->order->level}
                    - Order Subject: {$this->order->subject}
                    - Order Budget: {$this->order->budget}
                    - Order Format: {$this->order->format}
                    - Order Number of pages: {$this->order->numpages}
                    Best regards,
                    Homework Bubble Support Team"); // Markdown supported.
                    //->button('View Order', route('admin.order', $this->order->id)); // Inline Button
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
