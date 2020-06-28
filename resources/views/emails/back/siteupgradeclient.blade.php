<p>Hi {{ $user->name }}</p>
<p>We'd like to let you know that we have upgraded our website, as a result all your previous orders are not available in the current website upgrade</p>
<p>If you have an order in progress we will send it to you via your email <strong>{{ $user->email }}</strong></p>
<p>Since we do not store your passwords we have generated a new password which is <strong>{{ defaultsettings()['sitename'] }}</strong>. Use this password to loggin into your account and DO NOT forget to change your password.</p>
<p>As a valued customer to us, we have credited your account with $5 balance.</p>
<p><strong>Psst! Remember - this is not a marketing email. Since you have {{ defaultsettings()['sitename'] }} Account, we want to keep you informed about transactions, operational updates or changes to our websites.</strong></p>
<p>Best regards,</p>
<p>{{ defaultsettings()['sitename'] }} Support Team</p>

