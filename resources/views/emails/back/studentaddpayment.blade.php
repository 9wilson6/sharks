@component('mail::message')
Dear user

This is to inform you that we have received your payment. Below are the details

- Amount: ${{ $payment->amount }}
- Payment Method: {{ $payment->payment_method }}
- Transactioncode: {{ $payment->transaction_id }}

If you have any questions, please feel free to contact us 24/7 and we'll be more than happy to help you. We sincerely appreciate your interest in our services!

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent

