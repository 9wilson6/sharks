@component('mail::message')
Dear {{ $tutor->name }}

Kindly note that your account has been unverified.
Probable reason; Exceeded the number of allowed refunds
Your account will automatically be verified after one month
If you have any questions, please feel free to contact us 24/7 and we'll be more than happy to help you.
We sincerely appreciate your interest in our services!

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent
