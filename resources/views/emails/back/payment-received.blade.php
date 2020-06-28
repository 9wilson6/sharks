@component('mail::message')
Dear {{ $prelease->tutor->name }}

You got paid. You have received payment from **{{ $prelease->student->name }}** for Order# **{{ $prelease->id }}**

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent

