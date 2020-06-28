@extends('layouts.masterback')
@section('title', 'Scholarship Subscriptions: '.defaultsettings()['sitename'])
@section('heading', 'Scholarship Subscriptions')
@section('content')
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">Scholarship Subscription Options</div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <td></td>
                    <td>
                        Free
                        <br /> $0.00/month
                    </td>
                    <td>
                        Basic
                        <br /> $9.95/month
                    </td>
                    <td>
                        Premium
                        <br /> $29.95/month
                    </td>
                    <th>
                        Ace
                        <br /> $49.95/month
                    </th>
                    <td>
                        Platinum
                        <br /> $99.95/month
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <a class="btn btn-default" href="upgradescholarship?plan=1" class="classname">Get Started</a>
                    </td>
                    <td>
                        <a class="btn btn-default" href="upgradescholarship?plan=2" class="classname">Get Started</a>
                    </td>
                    <td>
                        <a class="btn btn-default" href="upgradescholarship?plan=3" class="classname">Get Started</a>
                    </td>
                    <td>
                        <a class="btn btn-default" href="upgradescholarship?plan=4" class="classname">Get Started</a>
                    </td>
                    <td>
                        <a class="btn btn-default" href="upgradescholarship?plan=4" class="classname">Get Started</a>
                    </td>
                </tr>
                <tr>
                    <td> <b>24/7 HBubble Support</b>
                        <br /> Message us for a fast response
                    </td>
                    <td>
                        <img src="{{ asset('img/Check-32.png') }}" /></td>
                    <td>
                        <img src="{{ asset('img/Check-32.png') }}" /></td>
                    <td>
                        <img src="{{ asset('img/Check-32.png') }}" /></td>
                    <td>
                        <img src="{{ asset('img/Check-32.png') }}" /></td>
                    <td>
                        <img src="{{ asset('img/Check-32.png') }}" /></td>
                </tr>
                <tr>
                    <td> <b>Profile Specialization</b>
                        <br /> Number of project subjects you can bid on
                    </td>
                    <td>2</td>
                    <td>3</td>
                    <td>5</td>
                    <td>9</td>
                    <td>All</td>
                </tr>
                <tr>
                    <td>
                        <b>Project Email Notifications</b>
                        <br /> Get automatic emails when a project matching your subjects is posted
                    </td>
                    <td>
                        <img src="{{ asset('img/Cross-32.png') }}" /></td>
                    <td>
                        <img src="{{ asset('img/Cross-32.png') }}" /></td>
                    <td>
                        <img src="{{ asset('img/Cross-32.png') }}" /></td>
                    <td>
                        <img src="{{ asset('img/Check-32.png') }}" />
                    <td>
                        <img src="{{ asset('img/Check-32.png') }}" /></td>
                </tr>
                <tr>
                    <td>
                        <b>Number of bids / month</b>
                        <br /> Max number of bids you can place in a month
                    </td>
                    <td>75</td>
                    <td>150</td>
                    <td>600</td>
                    <td>1200</td>
                    <td>Unlimited</td>
                </tr>
                <tr>
                    <td>
                        <b>Payout Methods</b>
                    </td>
                    <td>
                        Paypal
                        <br /> Payoneer
                    </td>
                    <td>
                        Paypal
                        <br /> Payoneer
                    </td>
                    <td>
                        Paypal
                        <br /> Payoneer
                    </td>
                    <td>
                        Paypal
                        <br /> Payoneer
                    </td>
                    <td>
                        Paypal
                        <br /> Payoneer
                        <br /> Western Union*
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>View Featured Projects</b>
                        <br /> Bid on featured projects
                    </td>
                    <td>
                        <img src="{{ asset('img/Cross-32.png') }}" /></td>
                    <td>
                        <img src="{{ asset('img/Cross-32.png') }}" /></td>
                    <td>
                        <img src="{{ asset('img/Check-32.png') }}" /></td>
                    <td>
                        <img src="{{ asset('img/Check-32.png') }}" /></td>
                    <td>
                        <img src="{{ asset('img/Check-32.png') }}" /></td>
                </tr>
                <tr>
                    <td>
                        <b>Bookmark Projects</b>
                        <br /> View projects later
                    </td>
                    <td>
                        <img src="{{ asset('img/Cross-32.png') }}" /></td>
                    <td>
                        <img src="{{ asset('img/Cross-32.png') }}" /></td>
                    <td>
                        <img src="{{ asset('img/Check-32.png') }}" /></td>
                    <td>
                        <img src="{{ asset('img/Check-32.png') }}" /></td>
                    <td>
                        <img src="{{ asset('img/Check-32.png') }}" /></td>
                </tr>
                <tr>
                    <td>
                        <b>Favorite Students</b>
                        <br /> Get an email every time your favorite student posts a project
                    </td>
                    <td>
                        <img src="{{ asset('img/Cross-32.png') }}" /></td>
                    <td>
                        <img src="{{ asset('img/Cross-32.png') }}" /></td>
                    <td>
                        <img src="{{ asset('img/Cross-32.png') }}" /></td>
                    <td>
                        <img src="{{ asset('img/Check-32.png') }}" /></td>
                    <td>
                        <img src="{{ asset('img/Check-32.png') }}" /></td>
                </tr>
            </table>
            *Western Union payments are made on last Friday of month and a separate fee of $30 is assessed on
            withdrawal
            <br />
            <h2>Can I cancel anytime?</h2> You may cancel anytime
            <br />
            <h2>Can I switch plans?</h2> You can upgrade anytime but must wait for the current plan to expire in order
            to downgrade
            <h2>Will I be billed automatically every month?</h2> Your plan will expire after 30 days and you will have
            to renew plan manually
            <h2>Can I pay with Paypal?</h2> If you do not have funds in your account, you may pay us via Paypal.
            Contact help for assistance. ..
            <br />
            <!-- /.row -->
        </div>
        <!-- /.panel-body -->
    </div>

</div>
@stop