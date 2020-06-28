@component('mail::message')
Dear tutor

Your bid for Order# {{ $orderid }} has been accepted by the client and the project has been funded.
Click here to View order details: [View Order details](route('tutor.order', $orderid))

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent

