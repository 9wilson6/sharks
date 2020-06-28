@component('mail::message')
Dear admin

The below tutor has been unverified
Probable reasons; Exceeded the number of refunds per month

- Tutor Name: {{ $tutor->fullname }}
- Tutor Username: {{ $tutor->name }}
- Tutor email: {{ $tutor->email }}

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent
