@extends('layouts.masterback')
@section('title', 'Tutors: '.defaultsettings()['sitename'])
@section('heading', 'All Tutors')
@section('content')
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading"> <i class="fa fa-clock-o fa-fw"></i> All tutors
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <th scope="col">Tutor name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Username</th>
                    <th scope="col">Created</th>
                    <th scope="col">Verified</th>
                    <th scope="col">Actions</th>
                </tr>
                @foreach($users as $user)
                <tr>
                    <td><a href="#">{{ $user->fullname }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
                    <td>{{ $user->profile->verified === null ? 'No' : 'Yes' }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="#" type="button" class="btn btn-sm btn-success"><strong>Edit</strong></a>
                            <a href="#" onclick="return confirm('Are you sure you want to reset the tutors\' password? A new password will be generated and sent to the tutor\'s email');" type="button" class="btn btn-sm btn-default"><strong>Reset</strong></a>
                            @if ($user->profile->verified === null)
                                <a href="#" onclick="return confirm('You are about to mark this tutor as verified. After the tutor is verified, He/she will be able to place bids. Click on the tutors\' link to view their documents before verifying');" type="button" class="btn btn-sm btn-info"><strong>Verify</strong></a>
                            @else
                                <a href="#" onclick="return confirm('Are you sureyou wantto unverify?');" type="button" class="btn btn-sm btn-warning"><strong>Unverify</strong></a>
                            @endif

                            @if(Auth::user()->hasRole('admin'))
                                <a href="#" onclick="return confirm('Are you sure you want to delete this tutor? This action is not reversible, consider unverifying the tutor instead');" type="button" class="btn btn-sm btn-danger"><strong>Delete</strong></a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </table>
            {{ $users->links() }}
        </div>
    </div>
</div>
@stop

