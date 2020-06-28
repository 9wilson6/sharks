@extends('layouts.masterback')
@section('title', 'Edit User: '.defaultsettings()['sitename'])
@section('heading', 'Edit user')
@section('content')
<div class="panel panel-default">
<div class="panel-heading"> Edit tutor {{ $tutor->fullname }}</div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <form name="form" method="post" action="{{ route('admin.tutors.update', $tutor->id) }}">
            {{ csrf_field() }}
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <td valign="top">
                        <label for="name">Username:</label>
                    </td>
                    <td valign="top">
                        <div class="form-group @if ($errors->has('name')) has-error @endif">
                            <input class="form-control" type="text" value="{{ $tutor->name }}" name="name" required>
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
                            <input class="form-control" type="text" value="{{ $tutor->fullname }}" name="fullname" required>
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
                            <input class="form-control" type="text" value="{{ $tutor->email }}" name="email" required>
                            @if ($errors->has('email'))
                                <p class="help-block">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                    </td>
                </tr>
            </table>
            <button type="submit" class="btn btn-primary btn-block btn-lg"><strong>Edit tutor</strong></button>
        </form>
        <hr>
    </div>
</div>

@stop
