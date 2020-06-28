@component('mail::message')
Dear tutor

Dispute for order#{{ $order_id }} has been withdrawn by client

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent

