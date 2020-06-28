@component('mail::message')
Dear tutor

Please stop working on order #**{{ $orderid }}**. A refund has been issued to the client.

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent

