@component('mail::message')
Dear user

Your profile information was changed. Please double check payment info. If you did not make any changes, please email admin immediately. Your account may have been hacked.

@component('mail::button', ['url' => route('login'), 'color' => 'primary'])
    Login
@endcomponent

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent

