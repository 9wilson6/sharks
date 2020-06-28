@component('mail::message')
Dear Admin

This is to inform you that there is a new payment by student. Below are the details

- Student email: {{ $user->email }}
- Amount: ${{ $payment->amount }}
- Payment Method: {{ $payment->payment_method }}
- Transaction code: {{ $payment->transaction_id }}

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent