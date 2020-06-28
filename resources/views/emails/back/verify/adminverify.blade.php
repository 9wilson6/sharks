@component('mail::message')
Dear admin

The below tutor has been verified successfully
The tutor will now be able to place bids

- Tutor Name: {{ $tutor->fullname }}
- Tutor Username: {{ $tutor->name }}
- Tutor email: {{ $tutor->email }}

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent

