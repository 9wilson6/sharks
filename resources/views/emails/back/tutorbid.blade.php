@component('mail::message')
Dear user

We wanted to let you know that multiple scholars have bid on your project titled: **{{ $order->title }}**. Click button below to review bids and assign project:

@component('mail::button', ['url' => route('student.order.details', $order->id), 'color' => 'primary'])
    Order details
@endcomponent

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent