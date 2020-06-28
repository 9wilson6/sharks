@component('mail::message')
Dear tutor

Client want a Revision for order# {{ $revision->order_id }}

- **Provision:** {{ $revision->provision }}
- **Instructions:** {{ $revision->instruction }}

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent

