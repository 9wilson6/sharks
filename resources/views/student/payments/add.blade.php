@extends('layouts.masterback')
@section('title', 'Add Payments: '.defaultsettings()['sitename'])
@section('heading', 'Add Funds')
@section('content')
    <div class="col-lg-12">
        @if (session('status'))
            <div class="alert alert-success">
                <strong>{{ session('status') }}</strong>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                <strong>{{ session('error') }}</strong>
            </div>
        @endif
        @if (isset($_GET['token']))
            <div class="alert alert-danger">
                <strong>Payment was cancelled.</strong>
            </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading"> <i class="fa fa-clock-o fa-fw"></i>Add Payments </div>
            <div id="add-funds" class="panel-body">
                <div class="row">
                    <div class="col-md-8 col-lg-8 col-sm-12">
                        <h3><strong>Available balance: ${{ Auth::user()->studentpayments->sum('amount') - Auth::user()->studentwithdrawal->sum('amount') }}</strong></h3>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-12">
                        <h3><a class="pull-right" href="#"> <i class="fa fa-money"></i> <strong>Withdraw</strong></a></h3>
                    </div>
                </div>
                <add-funds></add-funds>
            </div>
        </div>
    </div>
@stop
@section('addfunds')
    <script src="{{ asset('js/addfunds.js')}}"></script>    
@endsection