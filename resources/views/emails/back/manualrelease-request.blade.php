@switch($sendto)
    @case('admin')
        @component('mail::message')
        Dear admin

        Tutor {{ $order->tutor->name }} has requested for manual release for order #{{ $order->id }}. Below is the order details

        - Student name: {{ $order->student->name }}
        - Tutor name: {{ $order->tutor->name }}
        - Tutor email: {{ $order->tutor->email }}
        - Agreed amount: {{ $order->agreed_amount }}

        Log in to your account and release the payment

        @component('mail::button', ['url' => route('login'), 'color' => 'primary'])
            Login
        @endcomponent

        Kind Regards,

        {{ defaultsettings()['sitename'] }} Support Team
        @endcomponent
        @break
    @case('tutor')
        @component('mail::message')
        Dear {{ $order->tutor->name }}

        Your manual release request was successful. Kindly await the admin to approve this request

        Kind Regards,

        {{ defaultsettings()['sitename'] }} Support Team
        @endcomponent
        @break
@endswitch
