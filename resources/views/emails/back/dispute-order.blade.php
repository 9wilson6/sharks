@component('mail::message')
# Order #{{ $dispute['order_id'] }} has been disputed by the student.
Reason for dispute is as below.

- **{{ $dispute['reason'] }}**

Contact the student using messaging system to withdraw dispute.

If the dispute escalate, the order will be deleted and funds refunded to the student.

You have 24 hours to resolve dispute with the student.

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent
