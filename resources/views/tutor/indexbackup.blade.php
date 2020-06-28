@extends('layouts.masterback')
@section('title', 'Tutors: '.defaultsettings()['sitename'])
@section('heading', 'All Tutors')
@section('content')
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading"><h4>All tutors <a href="{{ route('admin.tutors.create') }}" class="pull-right btn btn-primary"><strong>Add tutor</strong></a></h4></div>
        <div class="panel-body">
            @if(session('error'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>{{ session('error') }}</strong>
                </div>
            @endif
            @if(session('status'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong> {{ session('status') }}</strong>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <th scope="col">Tutor username</th>
                        <th scope="col">Email</th>
                        {{-- <th scope="col">Created</th> --}}
                        <th scope="col">Verified</th>
                        <th scope="col">Awarded</th>
                        <th scope="col">Disputed</th>
                        <th scope="col">Balance</th>
                        <th scope="col">Actions</th>
                    </tr>
                    @foreach($users as $user)
                    <tr>
                        <td><a href="{{ route('admin.scholarprofile', $user->id) }}"><strong>{{ $user->name }}</strong></a></td>
                        <td>{{ $user->email }}</td>
                        {{-- <td>{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td> --}}
                        <td>
                            @if ($user->profile->verified === null)
                                <img src="{{ asset('img/cross.png') }}" width="20" height="20" class="img-responsive" alt="No">
                            @else
                                <img src="{{ asset('img/tick.png') }}" width="20" height="20" class="img-responsive" alt="Yes">
                            @endif
                        </td>
                        <td><a href="{{ route('admin.tutors.awarded', $user->id) }}"><strong>({{ $user->orderawards->count() }}) view</strong></a></td>
                        <td><a href="{{ route('admin.tutors.disputed', $user->id) }}"><strong>({{ $user->disputedorders->count() }}) view</strong></a></td>
                        <td><strong> <i class="fa fa-money fa-fw"></i> $ {{ number_format($user->tutorpayments->sum('amount') - $user->tutorwithdrawals->sum('amount'), 2) }}</strong></td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.tutors.edit', $user->id) }}" type="button" class="btn btn-sm btn-success"><strong>Edit</strong></a>
                                <a href="{{ route('admin.tutors.reset', $user->id) }}" onclick="return confirm('Are you sure you want to reset the tutors\' password? A new password will be generated and sent to the tutor\'s email');" type="button" class="btn btn-sm btn-default"><strong>Reset</strong></a>
                                @if ($user->profile->verified === null)
                                    <a href="{{ route('admin.tutors.verify', $user->id) }}" onclick="return confirm('You are about to mark this tutor as verified. After the tutor is verified, He/she will be able to place bids. Click on the tutors\' link to view their documents before verifying');" type="button" class="btn btn-sm btn-primary"><strong>Verify</strong></a>
                                @else
                                    <a href="{{ route('admin.tutors.unverify', $user->id) }}" onclick="return confirm('Are you sure you want to unverify this tutor?');" type="button" class="btn btn-sm btn-info"><strong>Unverify</strong></a>
                                @endif
                                @if ($user->status != 1)
                                    <a href="{{ route('admin.tutors.unsuspend', $user->id) }}" onclick="return confirm('You are about to unsuspend this tutor. Are you sure?');" type="button" class="btn btn-sm btn-primary"><strong>Unsuspend</strong></a>
                                @else
                                    <a href="{{ route('admin.tutors.suspend', $user->id) }}" onclick="return confirm('Are you sure you want to suspend this tutor?, tutor will not be able to log in again after log out');" type="button" class="btn btn-sm btn-warning"><strong>Suspend</strong></a>
                                @endif
                                @if(Auth::user()->hasRole('superadmin'))
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('login-as-{{ $user->id }}').submit();" type="button" class="btn btn-sm btn-primary"><strong>Login as</strong></a>
                                    <form id="login-as-{{ $user->id }}" action="{{ route('admin.loginas') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $user->id }}" name="user_id">
                                    </form>
                                    <a href="{{ route('admin.tutors.payments', $user->id) }}" type="button" class="btn btn-sm btn-default"><strong>Payments</strong></a>
                                    <a href="{{ route('admin.tutors.delete', $user->id) }}" onclick="return confirm('Are you sure you want to delete this tutor? This action is not reversible, consider unverifying the tutor instead');" type="button" class="btn btn-sm btn-danger"><strong>Delete</strong></a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            {{ $users->links() }}
        </div>
    </div>
</div>
@stop

