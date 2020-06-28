@component('mail::message')
Dear user

You have received a new message from {{ $user['name'] }}

Please click here to read it:

@component('mail::button', ['url' => route('login'), 'color' => 'primary'])
    Read message
@endcomponent

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent