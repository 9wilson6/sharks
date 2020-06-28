@component('mail::message')
Dear user

You have a new Message from {{ defaultsettings()['sitename'] }} User. Click here to view the email:
@component('mail::button', ['url' => '{{ defaultsettings()['siteemail'] }}/messages', 'color' => 'primary'])
    View Message
@endcomponent

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent
