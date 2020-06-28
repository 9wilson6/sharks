@extends('layouts.masterfront')
@section('content')
<div class="content-section-a">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                <form role="form" method="POST" class="reg_pass" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <h2>Earn Money by becoming a tutor <small></small></h2>
                    <a href="{{ route('login') }}">Already a member?</a>
                    <br>
                    <hr class="colorgraph">
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control input-lg"
                            placeholder="Name" tabindex="3"> @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span> @endif
                    </div>
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" name="email" value="{{ old('email') }}" id="email"
                            class="form-control input-lg" placeholder="Email Address" tabindex="4"> @if
                        ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span> @endif
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <input type="password" name="password" id="password" class="form-control input-lg"
                                    placeholder="Password" tabindex="5"> @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span> @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group @if ($errors->has('password_confirmation')) has-error @endif">
                                <input type="password" name="password_confirmation" id="password-confirm"
                                    class="form-control input-lg" placeholder="Confirm Password" tabindex="6">
                                @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span> @endif
                            </div>
                        </div>
                    </div>
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <input name="submit" type="submit" value="Submit" class="btn btn-primary btn-block btn-lg"
                                tabindex="7">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 center">
                        <span>By Creating an account, you agree to our Terms of Service and Privacy Policy.</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
