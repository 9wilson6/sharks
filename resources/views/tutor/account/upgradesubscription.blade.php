@extends('layouts.masterback')
@section('title', 'Upgrade Scholarship: '.defaultsettings()['sitename'])
@section('heading', 'Upgrade Scholarship')
@section('content')
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Plan Details
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <h3>One step away to enjoying member benefits!</h3>
            <br />
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <th>Membership Plan</th>
                </tr>
                <tr>
                    <td>Free</td>
                    <td>$0</td>
                </tr>
                <tr>
                    <td><b>Total</b></td>
                    <td><strong>$0</strong></td>
                </tr>
            </table>
        </div>
        <!-- /.panel-body -->
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">Account Balance</div>
        <div class="panel-body">
            <h3>Account Balance</h3>
            <table>
                <tr>
                    <td>$ 11.29</td>
                </tr>
            </table>
            <a class="btn btn-success" href="#">Subscribe</a>
        </div>
    </div>

</div>
@stop