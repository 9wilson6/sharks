@component('mail::message')
Dear tutor

Your withdrawal in the amount of: ${{ $withdraw->amount }} has been started
Your payment will be deposited to your payment method in your Profile : **{{ $user->profile->payment_method === null ? 'Payment method not set': $user->profile->payment_method }}** Not later than coming Sunday 11:59 PM (PT)
If you have any questions, please feel free to contact us 24/7 and we'll be more than happy to help you.
We sincerely appreciate your interest in our services!

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent

