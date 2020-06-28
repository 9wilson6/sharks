@component('mail::message')
Dear {{ $email['user'] }}

Your password has been successfully changed.

- Your username is: **{{ $email['email'] }}** and

- Your new password is: **{{ $email['password'] }}**

@component('mail::button', ['url' => route('home'), 'color' => 'primary'])
    Logon to {{ defaultsettings()['sitename'] }}
@endcomponent

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent