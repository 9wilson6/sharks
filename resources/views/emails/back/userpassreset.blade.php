@component('mail::message')
Dear {{ $user->name }}

Your password has been successfully reset by the admin
To log into your personal account, please use this information:

- Email: {{ $user->email }}
- Password: {{ $pass }}

If you have any questions, please feel free to contact us 24/7 and we'll be more than happy to help you.
We sincerely appreciate your interest in our services!

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent

