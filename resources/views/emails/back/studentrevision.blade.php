@component('mail::message')
Dear user

Your request for revision for order# {{ $revision->order_id }} has been sent &amp; the tutor has been notified  to start working on it.

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent

