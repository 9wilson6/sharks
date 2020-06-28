@extends('layouts.app')
@section('title', 'MyHomework Shark: Login')
@section('content')
<div class="content-section-a">
    <div class="container">
        <div class="row">
            <div class="row" style="margin-top:20px">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                    <form id="login_form" role="form" id="login_form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <fieldset>
                            <div style="display:none;" id="succe_verify"></div>
                            <h2>Please Sign In</h2>
                            <hr class="colorgraph">
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control input-lg" placeholder="Email" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <input type="password" name="password" id="password" value="" class="form-control input-lg" placeholder="Password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <span class="button-checkbox">
                                     <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                    <a href="{{ route('password.request') }}" class="btn btn-link pull-right">Forgot Password?</a>
                                </span>
                            <hr class="colorgraph">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <input type="submit" class="btn btn-lg btn-success btn-block" name="loginin" id="loginin" value="Submit">
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <a href="{{ url('/register') }}" class="btn btn-lg btn-primary btn-block">New User</a>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->
</div>
@endsection
