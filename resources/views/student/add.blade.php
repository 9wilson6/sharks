@extends('layouts.masterback')
@section('title', 'Add student: '.defaultsettings()['sitename'])
@section('heading', 'Add student')
@section('content')
<div class="panel panel-default">
<div class="panel-heading"> Add student</div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <form name="form" method="post" action="{{ route('admin.clients.store') }}">
            {{ csrf_field() }}
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <td valign="top">
                        <label for="name">Username: <small>(Should be unique)</small></label>
                    </td>
                    <td valign="top">
                        <div class="form-group @if ($errors->has('name')) has-error @endif">
                            <input class="form-control" type="text" value="{{ old('name') }}" name="name" required>
                            @if ($errors->has('name'))
                                <p class="help-block">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <label for="fullname">Full name:</label>
                    </td>
                    <td valign="top">
                        <div class="form-group @if ($errors->has('fullname')) has-error @endif">
                            <input class="form-control" type="text" value="{{ old('fullname') }}" name="fullname" required>
                            @if ($errors->has('fullname'))
                                <p class="help-block">{{ $errors->first('fullname') }}</p>
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <label for="email">Email:</label>
                    </td>
                    <td valign="top">
                        <div class="form-group @if ($errors->has('email')) has-error @endif">
                            <input class="form-control" type="text" value="{{ old('email') }}" name="email" required>
                            @if ($errors->has('email'))
                                <p class="help-block">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <label for="password">Password:</label>
                    </td>
                    <td valign="top">
                        <div class="form-group @if ($errors->has('password')) has-error @endif">
                            <input class="form-control" type="password" name="password" required>
                            @if ($errors->has('password'))
                                <p class="help-block">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                    </td>
                </tr>

                <tr>
                    <td valign="top">
                        <label for="password_confirmation">Confirm Password:</label>
                    </td>
                    <td valign="top">
                        <div class="form-group @if ($errors->has('password_confirmation')) has-error @endif">
                            <input class="form-control" type="password" name="password_confirmation" required>
                            @if ($errors->has('password_confirmation'))
                                <p class="help-block">{{ $errors->first('password_confirmation') }}</p>
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <label for="sendemail">Notify user: <small>(Via email)</small></label>
                    </td>
                    <td valign="top">
                        <div class="form-group">
                             <input type="checkbox" name="sendemail" id="sendemail" value="yes" {{ old('sendemail') ? 'checked' : '' }}>
                        </div>
                    </td>
                </tr>
            </table>
            <button type="submit" class="btn btn-primary btn-block btn-lg"><strong>Add student</strong></button>
        </form>
        <hr>
    </div>
</div>

@stop
