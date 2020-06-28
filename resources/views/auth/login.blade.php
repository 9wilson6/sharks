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
                                <p class="text-center">
                                    Sign Up today and get lots of benefits.
                                </p><hr>
                                <form role="form" class="margin-b-20" method="post" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <?php
                                        //echo json_encode(session('fromhome'));
                                        $from = session('fromhome');
                                        //echo $from['email'];
                                            if (!empty($from)) {
                                                $emai = $from['email'];;
                                            } else {
                                                $emai = old('email');
                                            }
                                        ?>
                                        <label for="email">Email address</label>
                                        <input type="email" name="email" id="email" value="{{ $emai }}" class="form-control" required autofocus>
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
                                    <a href="{{ route('password.request') }}" class="btn btn-link pull-right"> <strong>Forgot Password?</strong></a>
                                    <div class="text-center">
                                        <input type="submit" value="Login here" class="btn btn-lg btn-primary btn-block">
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
