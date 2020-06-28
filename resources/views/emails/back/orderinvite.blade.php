@component('mail::message')
Dear {{ $user->fullname ?? $user->name }}

You are invited to work on order #**{{ $order->id }}**. If you are interested, please click on button below.

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent

