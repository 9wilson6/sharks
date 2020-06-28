@extends('layouts.masterback')
@section('title', 'Scholar Help: Homework Bubble')
@section('heading', 'Scholar Help')
@section('content')
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <p><strong>Tutors MUST observe below to avoid being banned or suspended:</strong></p>
            <ul>
                <li>Exchange of personal info including contacts is not allowed on this service, failure to observe
                    this will attract $150 penalty &amp; an inevitable total ban upon the second contravention.</li>
                <li>Plagiarism Cases will be treated with utmost seriousness. A penalty of 150$ will be charged If
                    convicted of plagiarized work &amp; proven guilty beyond any reasonable doubt.</li>
            </ul>
            <p>It is important to Note this service has zero tolerance policy for plagiarism and infringement of
                copyright. All work submitted on this website Must be your original work.</p>
            <p></p>
            <p><strong>How does this &ldquo;service&rdquo; work?</strong></p>
            <ul>
                <li>Login to your account</li>
                <li>Click on Find orders on home page</li>
                <li>Place bid on the order you are interested in &amp; chat client</li>
                <li>If client accepts your bid, you will receive a notification from {{ defaultsettings()['sitename'] }} work has been
                    assigned to you</li>
                <li>Deliver the work before deadline</li>
                <li>Client reviews the work &amp; release payment</li>
                <li>If client fails to release payment, Request for manual release &amp; wait for 20 days for money to
                    be released to your account</li>
            </ul>
            <p><strong>Revision</strong></p>
            <p>Client may request revision for their work. You will receive an email notification to make the necessary
                adjustments according to clients recommendations. Incomplete or late revision will be considered
                negligence on your part, be careful!</p>
            <p></p>
            <p><strong>When &amp; How do you get paid?</strong></p>
            <p>To Update your payment info, go to User profile &gt; edit profile, update then click on submit.</p>
            <p></p>
            <p><strong>How much Fees does the website charge you?</strong></p>
            <ul>
                <li>Level 4 - </li>
                <ul>
                    <li>Fee 45% More than 100 reviews</li>
                    <li>Rated 9.70 &amp; above</li>
                    <li>Bid to a max of $1000</li>
                </ul>
                <li>Level 3 - </li>
                <ul>
                    <li>Fee 55% More than 20 reviews</li>
                    <li>Rated 9.50 &amp; above</li>
                    <li>Bid to a max of $500</li>
                </ul>
                <li>Level 2 - </li>
                <ul>
                    <li>Fee 60% More than 5 reviews</li>
                    <li>Rated 9.00 &amp; above</li>
                    <li>Bid to a max of $100</li>
                </ul>

                <li>Level 1 - </li>
                <ul>
                    <li>Fee 65% Less than 5 reviews</li>
                    <li>Rated 9.90 &amp; above</li>
                    <li>Bid to a max of $25</li>
                </ul>
            </ul>
            <p><strong>What is our Refunds policy?</strong></p>
            <p>Note: if client complains you submitted work that was not done according to the requirements, a full
                refund will be made upon their request for refund (dispute)</p>
            <p>A refund raises your chances of getting suspended &amp; also shoots down your average rating, avoid it
                at all costs.</p>
            <p>A maximum of 24hrs is provided for you to resolve a dispute with client, failure to which it will auto
                escalate and charged 25$ resolution fee. Chargeback will attract a fee of $20</p>
            <p>Alternatively, you may Refund client to cancel dispute &amp; avoid dispute from escalating.</p>
            <p></p>
            <p><strong>IMPORTANT INFORMATION</strong></p>
            <p>Always make sure to view student profile before bidding on the work</p>
            <p>If the student is having problems assigning the work, advise him to email support @ <a href="mailto:{{ defaultsettings()['siteemail'] }}">{{ defaultsettings()['siteemail'] }}</a></p>
            <p>Other options include the following:</p>
            <p>Advise the student to repost the work and try assigning the work once more.</p>
            <p>You may also advise the client to log out, then login later on &amp; try assigning the work</p>
            <p></p>
            <p>Welcome &amp; best of luck!</p>
        </div>
    </div>

</div>
@stop
