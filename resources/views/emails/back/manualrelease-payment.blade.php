@switch($sendto)
    @case('admin')
        @component('mail::message')
        Dear admin

        You have successfully release payment for order #{{ $order->id }} to tutor {{ $order->tutor->name }}

        Kind Regards,

        {{ defaultsettings()['sitename'] }} Support Team
        @endcomponent
        @break
    @case('tutor')
        @component('mail::message')
        Dear {{ $order->tutor->name }}

        You got paid!. You have received a manual payment from admin for Order #{{ $order->id }}. You can withdraw your money by going into the PAYMENT section

        Kind Regards,

        {{ defaultsettings()['sitename'] }} Support Team
        @endcomponent
        @break
    @case('student')
        @component('mail::message')
        Dear {{ $order->student->name }}

        The admin has authorized a manual release for order #{{ $order->id }}

        Kind Regards,

        {{ defaultsettings()['sitename'] }} Support Team
        @endcomponent
        @break
@endswitch
