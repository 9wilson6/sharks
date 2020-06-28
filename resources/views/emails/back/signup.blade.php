@component('mail::message')
Dear {{ $user->fullname ?? $user->name }}

Thank you for signing up with [{{ defaultsettings()['sitename'] }}]({{ defaultsettings()['siteemail'] }}). To log into your personal account, please use this information. If you have any questions, please feel free to contact us 24/7 and we'll be more than happy to help you. We sincerely appreciate your interest in our services!

- Email: {{ $user->email }}
- Password: {{ $pass }}

If you would like to change your password - use this [Link]({{ url('/home/account/change-password') }}) to reset account use this [Link]({{ url('/password/reset') }})

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent