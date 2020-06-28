@extends('layouts.masterback')
@section('title', 'Request revision: '.defaultsettings()['sitename'])
@section('heading', 'Request revision')
@section('content')
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-clock-o fa-fw"></i> Request Revision
        </div>
        <div class="panel-body">
            <form name="form" method="post" action="{{ route('home.revision.save', $id) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <td>Time provision</td>
                        <td>
                            <input type='text' class="form-control" name="provision" id="provision" required />
                        </td>
                    </tr>
                    <tr>
                        <td>Instruction</td>
                        <td>
                            <div>
                                <textarea name="instruction" id="instruction" class="form-control" required></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Upload additional files</td>
                        <td>
                            <div>
                                <div class="form-group">
                                    <input type="file" class="form-control" name="upload_file">
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <button class="btn btn-danger" type="submit" name="submit" value="Submit">Request revision</button>
            </form>
        </div>
    </div>
</div>
@stop
