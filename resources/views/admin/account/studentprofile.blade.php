@extends('layouts.masterback')
@section('title', 'Student Profile: '.defaultsettings()['sitename'])
@section('heading', 'Student Profile')
@section('content')
<div class="col-lg-12">
    @if (session('status'))
        <div class="alert alert-success">
            <strong>{{ session('status') }}</strong>
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-bar-info-o fa-fw"></i> Student details
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <th>Email address</th>
                    <th>{{ $userdetails->email }}</th>
                </tr>
                <tr>
                    <td>Balance</td>
                    <td><a data-toggle="modal" href='#deductbalance'><strong> <i class="fa fa-money fa-fw"></i> $ {{ number_format($userdetails->studentpayments->sum('amount') - $userdetails->studentwithdrawal->sum('amount'), 2) }} (Deduct)</strong></a></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-clock-o fa-fw"></i> Profile Details
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <th>Quick Stats</th>
                    <th></th>
                </tr>
                <tr>
                    <td>Projects Posted</td>
                    <td>{{ $userdetails->orders->count() }}</td>
                </tr>
                <tr>
                    <td>Projects Awarded</td>
                    <td>{{ $userdetails->orders->where('date_awarded', '!=', null)->count() }}</td>
                </tr>
                <tr>
                <tr>
                    <td>Projects in progress</td>
                    <td>{{ $userdetails->orders->where('status', 4)->count() }}</td>
                </tr>
                <tr>
                    <td>Projects Closed</td>
                    <td>{{ $userdetails->orders->where('status', 6)->count() }}</td>
                </tr>
                <tr>
                    <td>Projects Disputed</td>
                    <td>{{ $userdetails->disputedorders->count() }}</td>
                </tr>
                {{-- <tr>
                    <td>Refunds Issued</td>
                    <td>{{ $orders['refunded'] }}</td>
                </tr> --}}
            </table>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-bar-info-o fa-fw"></i> Reviews
        </div>
        <div class="panel-body">
            @foreach($reviews as $review)
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <td><b>Review</b></td>
                    <td>Recommend</td>
                    <td>Order number</b></td>
                    <td>Comments</td>
                </tr>
                <tr>
                    <td><b>{{ $review->rating }}</b></td>
                    <td>{{ $review->recommend }}</td>
                    <td>{{ $review->rateable_id }}</td>
                    <td>{{ $review->comments }}</td>
                </tr>
            </table>
            @endforeach
        </div>
    </div>
</div>

<div class="modal fade" id="deductbalance">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><strong>Deduct or withdraw funds from student account</strong></h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.clients.withdraw', $userdetails->id) }}" method="post" role="form">
                    {{ csrf_field() }}
                    <legend>Withdraw/deduct funds</legend>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount to withdraw" required>
                    </div>
                    <div class="form-group">
                        <label for="transaction_id">Transaction id</label>
                        <input type="text" class="form-control" id="transaction_id" name="transaction_id" placeholder="Transaction id" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" required></textarea>
                    </div>
                    <button type="submit" onclick="alert('Are you sure you want to withdraw funds from this account? This action can not be undone');" class="btn btn-primary"> <strong><i class="fa fa-money fa-fw"></i> Withdraw funds</strong></button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
