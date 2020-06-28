@component('mail::message')
Dear user

You have successfully awarded project **#{{ $bidetails->order_id }}** to **{{ $bidetails->tutor->name }}**. The tutor has been notified to start working on it. Click here to View order details:

@component('mail::button', ['url' => route('student.order.details', $bidetails->order_id), 'color' => 'primary'])
    View Order details
@endcomponent

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent

