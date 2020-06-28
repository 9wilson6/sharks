@component('mail::message')
Dear user

Solution for order# {{ $orderdetails->id }} has been uploaded. Tutor {{ $orderdetails->tutor->name }} has uploaded the solution. Login to your account &amp; open the project to download the solution.

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent


