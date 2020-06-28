@extends('layouts.masterback')
@section('title', 'Upload Solution: '.defaultsettings()['sitename'])
@section('heading', 'Upload Solution')
@section('content')
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-clock-o fa-fw"></i> File Upload
        </div>
        <div class="panel-body">
            @if(session('error'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>{{ session('error') }}</strong>
                </div>
            @endif
            @if(session('status'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong> {{ session('status') }}</strong>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><strong>{{ $error }}</strong></li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <p>
                <i>Bummer! File exceeds maximum allowed size?</i><br />
                <i>Use <a target="_blank" href="https://www.mediafire.com/">www.mediafire.com</a> or <a target="_blank" href="https://www.wikiupload.com/">www.wikiupload.com</a> to attach file and share the link with your tutor via messages or go to “edit
                            order” to include the link.</i>
            </p>
            <form method="post" enctype="multipart/form-data" action="{{ route('tutor.solution.add', $order_id) }}">
                {{ csrf_field() }}
                <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <td><strong>Upload Solution: 1</strong></td>
                        <td>
                            <input class="form-control" name="upload_file[]" id="upload_file" type="file" class="inputtext" />
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Upload Solution: 2</strong></td>
                        <td>
                            <input class="form-control" name="upload_file[]" id="upload_file" type="file" class="inputtext" />
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Upload Solution: 3</strong></td>
                        <td>
                            <input class="form-control" name="upload_file[]" id="upload_file" type="file" class="inputtext" />
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Upload Solution: 4</strong></td>
                        <td>
                            <input class="form-control" name="upload_file[]" id="upload_file" type="file" class="inputtext" />
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Upload Solution: 5</strong></td>
                        <td>
                            <input class="form-control" name="upload_file[]" id="upload_file" type="file" class="inputtext" />
                        </td>
                    </tr>
                </table>
                <button class="btn btn-danger" type="submit" class="classname"> Upload Solution(s)</button>
            </form>
        </div>
    </div>
    <center><a class="btn btn-primary" href="{{ url('tutor.order', $order_id) }}"><i class="fa fa-search-o fa-fw"></i>View Project</a></center>
</div>
@stop
