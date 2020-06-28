@component('mail::message')
Dear {{ $orderdetails->student->name }}

You have started a dispute for project titled **{{ $orderdetails->title }}**. If you fail to resolve the issue with the tutor &amp; withdraw the dispute within 48hrs, a refund will be issued to you.

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent

