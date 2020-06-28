@extends('layouts.auth')
@section('title', 'MyHomework Shark: Homeworkhelp for students')
@section('content')
<div class="display-table">
            <div class="verticle-middle">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3 col-md-8 offset-lg-3">
                            <div class="misc-box">
                                <h3 class="margin-b-0 text-center">Change your password?</h3>
                                <p class="text-center">
                                    Always use a complex password.
                                </p><hr>

                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form role="form" class="margin-b-20" method="post" action="{{ route('password.request') }}">
                                {{ csrf_field() }}
                                 <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email">Email address</label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" required autofocus>
                                        @if ($errors->has('email'))
                                            <span style="color: red;" class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" required>
                                        @if ($errors->has('password'))
                                            <span style="color: red;" class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                        <label for="password_confirmation">Password</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                                        @if ($errors->has('password_confirmation'))
                                            <span style="color: red;" class="help-block">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="text-center">
                                        <input type="submit" value="Reset Password" class="btn btn-lg btn-primary btn-block">
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
