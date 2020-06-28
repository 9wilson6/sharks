@component('mail::message')
Dear admin

Student {{ $orderdetails->student->name }} has started a dispute for project titled: **{{ $orderdetails->title }}**. Reason given by student for disputing:

- {{ $dispute->reason }}

Click the button below for dispute details:

@component('mail::button', ['url' => route('admin.order', $orderdetails->id), 'color' => 'primary'])
    View dispute details
@endcomponent

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent
