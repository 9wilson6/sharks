@extends('layouts.auth')
@section('title', 'MyHomework Shark: Homeworkhelp for students')
@section('content')
<div class="display-table">
            <div class="verticle-middle">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3 col-md-8 offset-lg-3">
                            <div class="misc-box">
                                <h3 class="margin-b-0 text-center">Forgot your passward?</h3>
                                <p class="text-center">
                                    Well, It happens all the time.
                                </p><hr>
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form role="form" class="margin-b-20" method="post" action="{{ route('password.email') }}">
                                {{ csrf_field() }}
                                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email">E-Mail Address</label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" required autofocus>
                                        @if ($errors->has('email'))
                                            <span style="color: red;" class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="text-center">
                                        <input type="submit" value="Send Password Reset Link" class="btn btn-lg btn-primary btn-block">
                                    </div>
                                </form>
                            </div>
                            <span class="copyright">&copy; Copyright 2016- {{ date('Y') }}. Myhomeworkshark.com</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop
