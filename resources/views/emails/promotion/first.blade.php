@component('mail::message')
Dear admin

Student fdgfdgfdg has started a dispute for project titled: **fdgfdgfdgfdg**. Reason given by student for disputing:

- gffdsfdsgfdsgdsfsdgfdsgfdsgfdsgsfd

Click the button below for dispute details:

@component('mail::button', ['url' => route('home'), 'color' => 'primary'])
    View dispute details
@endcomponent

Kind Regards,

{{ defaultsettings()['sitename'] }} Support Team
@endcomponent
