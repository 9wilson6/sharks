@extends('layouts.masterback')
@section('title', 'My Profile: '.defaultsettings()['sitename'])
@section('heading', 'My Profile')
@section('content')
<div class="col-lg-12">
    <div class="col-lg-12">
        <a href="{{ route('student.edit') }}" class="btn btn-large btn-primary"><strong>Edit profile</strong></a>
        @if (session('status'))
            <div class="alert alert-success">
                <strong>{{ session('status') }}</strong>
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <td>User</td>
                    <td>{{ Auth::user()->name }}</td>
                </tr>
                <tr>
                    <td>Your Name</td>
                    <td>{{ Auth::user()->fullname }}</td>
                </tr>
                <tr>
                    <td>Email </td>
                    <td>{{ Auth::user()->email }}</td>
                </tr>
                <tr>
                    <td>Date Registered</td>
                    <td>{{ Auth::user()->created_at }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@stop
