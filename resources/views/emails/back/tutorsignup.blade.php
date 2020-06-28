@component('mail::message')
Dear {{ $user->name }}

Thank you for registering at [{{ defaultsettings()['sitename'] }}]({{ defaultsettings()['siteemail'] }}). To log into your personal account, please use this information:

- Email: {{ $user->email }}
- Password: {{ $pass }}

If you would like to change your password - use this [Link]({{ url('/account/change-password') }}) to reset account use this [Link]({{ url('/password/reset') }}). We sincerely appreciate your interest in our services!

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent

