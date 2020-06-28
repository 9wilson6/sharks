@component('mail::message')
Dear {{ $user->fullname ?? $user->name }}

A new order is available for your review, Use the link below to view the order and place your bid.
Click the button below for order details:

@component('mail::button', ['url' => route('tutor.order', $order->id), 'color' => 'success'])
    Order Page
@endcomponent

Kindly check all the instructions and make sure that you can complete it on time before you place your bid.

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent
