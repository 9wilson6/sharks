@extends('layouts.masterback')
@section('title', 'Edit my profile: '.defaultsettings()['sitename'])
@section('heading', 'Edit my profile')

@section('content')
<div class="col-lg-12">
    <div class="col-lg-12">
        <a href="{{ route('student.profile') }}" class="btn btn-large btn-primary"><strong>View profile</strong></a>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li><strong>{{ $error }}</strong></li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="table-responsive">
            <form action="{{ route('student.updateprofile') }}" method="POST">
                @csrf
                <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <td>User</td>
                        <td><input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}"></td>
                    </tr>
                    <tr>
                        <td>Your name</td>
                        <td><input type="text" class="form-control" name="fullname" value="{{ Auth::user()->fullname }}"></td>
                    </tr>
                    <tr>
                        <td>Email </td>
                        <td><input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button class="btn btn-primary" type="submit"><strong>Save</strong></button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

@stop
