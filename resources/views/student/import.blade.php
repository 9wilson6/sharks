@extends('layouts.masterback')
@section('title', 'Import students: '.defaultsettings()['sitename'])
@section('heading', 'Import students')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"> Import students</div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <form enctype="multipart/form-data" name="form" method="post" action="{{ route('admin.clients.store.import') }}">
            {{ csrf_field() }}
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <td valign="top">
                        <label for="name">Import Users: <small><a href="{{ route('admin.clients.sample') }}">Download sample</a></small></label>
                    </td>
                    <td valign="top">
                        <div class="form-group">
                            <input class="form-control" type="file" name="studentfile" required>
                        </div>
                    </td>
                </tr>
            </table>
            <button type="submit" class="btn btn-primary btn-block btn-lg"><strong>Import student</strong></button>
        </form>
        <hr>
    </div>
</div>
@stop
