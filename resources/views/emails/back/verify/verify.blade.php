@component('mail::message')
Dear {{ $tutor->name }}

Kindly note that your account has now been verified.
You can now proceed with bidding for new orders
If you have any questions, please feel free to contact us 24/7 and we'll be more than happy to help you.
We sincerely appreciate your interest in our services!

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent

