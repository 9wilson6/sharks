@extends('layouts.masterback')
@section('title', 'Change Password: '.defaultsettings()['sitename'])
@section('heading', 'Change Password')
@section('content')
    <div class="col-lg-6">
        @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form method="post" id="passwordForm" action="{{ route('admin.updatepassword') }}">
    {{ csrf_field() }}
        <input type="password" class="input-lg form-control" name="password" id="password" placeholder="New Password" autocomplete="off">
        <div class="row">
        </div>
        <input type="password" class="input-lg form-control" name="confirmpass" id="confirmpass" placeholder="Repeat Password" autocomplete="off">
        <div class="row">
        </div>
        <input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg" value="Change Password">
    </form>
    </div>
@stop
