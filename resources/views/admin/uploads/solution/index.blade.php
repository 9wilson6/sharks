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
            <p>
                <i>Max Allowed Combined File Size: 99 MB</i>
                <br />
                <i>Allowed file types: doc,docx,ppt,pptx,zip,7z,rar,txt,pdf,xls,xlsx,gif,jpg,jpeg,png,bmp,mp3,wav,java</i>
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
