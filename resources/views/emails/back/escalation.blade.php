@component('mail::message')
Dear user

Dispute for project #***** has been escalated. A $20 fee will be deducted from your account if we issue refund.

- {{ $dispute->reason }}

Click the button below for dispute details:

@component('mail::button', ['url' => route('admin.order', $orderdetails->id), 'color' => 'primary'])
    View dispute details
@endcomponent

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent
