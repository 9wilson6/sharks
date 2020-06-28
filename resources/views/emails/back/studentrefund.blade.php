@component('mail::message')
Dear user

Tutor has refunded order # **{{ $orderid }}**, a refund has been issued and added to your balance

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent

