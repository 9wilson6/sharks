@switch($sendto)
    @case('admin')
        @component('mail::message')
        Dear admin

        Dispute for Order # {{ $order->id }} has been escalated. A $25 fee will be deducted from the tutor account if a refund is issued. Below is the dispute details:
        - Student email: {{ $order->student->email }}
        - Tutor name: {{ $order->tutor->name }}
        - Tutor email: {{ $order->tutor->email }}
        Kind Regards,

        {{ defaultsettings()['sitename'] }} Support Team
        @endcomponent
        @break
    @case('tutor')
        @component('mail::message')
        Dear tutor

        Dispute for Order # {{ $order->id }} has been escalated. A $25 fee will be deducted from your account if we issue a refund.

        Kind Regards,

        {{ defaultsettings()['sitename'] }} Support Team
        @endcomponent
        @break
    @case('student')
        @component('mail::message')
        Dear student

        Dispute for Order # {{ $order->id }} has been escalated. Order has been refunded and amount credited to your account.

        Kind Regards,

        {{ defaultsettings()['sitename'] }} Support Team
        @endcomponent
        @break
@endswitch
