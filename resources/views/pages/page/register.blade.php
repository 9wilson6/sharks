@extends('layouts.auth')
@section('title', 'Myhomeworkshark: Homeworkhelp for students')
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
                                <form role="form" class="margin-b-20">
                                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name">Your name</label>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="Name">
                                        @if ($errors->has('name'))
                                         <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                         </span> 
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email">Email address</label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="Email Address">
                                        @if ($errors->has('email'))
                                         <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                         </span> 
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password">
                                        @if ($errors->has('name'))
                                         <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                         </span> 
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Confirm Password</label>
                                        <input type="password" class="form-control" id="password">
                                        @if ($errors->has('name'))
                                         <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                         </span> 
                                        @endif
                                    </div>
                                   <!--  <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> You have read &amp; agree to the 
                                            <a href="#">Terms of service</a>.
                                        </label>
                                    </div> -->
                                    <div class="text-center">
                                        <input type="button" value="Create my account" class="btn btn-lg btn-default btn-block">
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