@extends('layouts.auth')
@section('title', 'MyHomework Shark: Homeworkhelp for students')
@section('content')
<div class="display-table">
    <div class="verticle-middle">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-lg-3">
                    <div class="misc-box">
                        <h3 class="margin-b-0 text-center">Chat With Scholars Right Now!</h3>
                        <p class="text-center">Sign Up today and get lots of benefits.</p>
                        <hr>
                        <form role="form" method="post" class="margin-b-20" action="{{ route('register') }}">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('fullname') ? ' has-error' : '' }}">
                                <label for="fullname">Full name</label>
                                <input type="text" name="fullname" id="fullname" value="{{ old('fullname') }}" class="form-control">
                                @if ($errors->has('fullname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fullname') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Your username</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                                @if ($errors->has('name'))
                                <span style="color: red;" class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Email address</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
                                @if ($errors->has('email'))
                                <span style="color: red;" class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                                @if ($errors->has('password'))
                                <span style="color: red;" class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                @if ($errors->has('password_confirmation'))
                                <span style="color: red;" class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" checked> You have read &amp; agree to the  <a href="{{ url('/tos') }}">Terms of service</a>.
                                </label>
                            </div>
                            <div class="text-center">
                                <input type="submit" value="Create my account" class="btn btn-lg btn-primary btn-block">
                            </div>
                        </form>
                    </div>
                    <span class="copyright">&copy; Copyright 2016 - {{ date('Y') }}. Myhomeworkshark.com</span>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
