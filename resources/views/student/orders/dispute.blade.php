@extends('layouts.masterback')
@section('title', 'Dispute order: '.defaultsettings()['sitename'])
@section('heading', 'Dispute order')
@section('content')
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-clock-o fa-fw"></i> Dispute order
        </div>
        <div class="panel-body">
            <p>
                <i>You have 24 hours to withdraw the dispute</i>
                <br />
                <i>If you do not resolve your issues with the tutor within 24 hours, we will refund you your money to your balance within 48 hours</i>
                <br />
                <b>Please provide a detailed reason why you want to dispute this order.</b>
            </p>
            <form method="post" action="{{ route('home.dispute.save', $id) }}">
                {{ csrf_field() }}
                <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <td>Reason for Dispute: </td>
                        <td>
                            <textarea class="form-control" required name="reason" id="reason"></textarea>
                        </td>
                    </tr>
                </table>
                <button onclick="return confirm('Do you really want to Dispute this order??');" class="btn btn-danger" type="submit">
                    Dispute Order
                </button>
            </form>
        </div>
    </div>
    <center><a class="btn btn-primary" target="_blank" href="{{ route('student.order.details', $id) }}"><i class="fa fa-search-o fa-fw"></i>View Project</a></center>
</div>
@stop
