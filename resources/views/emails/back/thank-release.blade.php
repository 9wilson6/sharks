@component('mail::message')
Thank you for your payment

You have successfully awarded project **#{{ $thankforpayment->orderid }}** to **{{ $thankforpayment->tutorname }}**. The tutor has been notified to start working on it.

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent
