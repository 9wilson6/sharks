@extends('layouts.masterback')
@section('title', 'Upload Files: '.defaultsettings()['sitename'])
@section('heading', 'Upload Files')
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
                <br />
            </p>
            <form method="post" enctype="multipart/form-data" action="{{ route('admin.upload.save.order', $order_id) }}">
                {{ csrf_field() }}
                <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <td><strong>Upload File 1:</strong></td>
                        <td>
                            <input class="form-control" name="upload_file[]" id="upload_file" type="file" class="inputtext" />
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Upload File 2:</strong></td>
                        <td>
                            <input class="form-control" name="upload_file[]" id="upload_file" type="file" class="inputtext" />
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Upload File 3:</strong></td>
                        <td>
                            <input class="form-control" name="upload_file[]" id="upload_file" type="file" class="inputtext" />
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Upload File 4:</strong></td>
                        <td>
                            <input class="form-control" name="upload_file[]" id="upload_file" type="file" class="inputtext" />
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Upload File 5:</strong></td>
                        <td>
                            <input class="form-control" name="upload_file[]" id="upload_file" type="file" class="inputtext" />
                        </td>
                    </tr>
                </table>
                <button class="btn btn-danger" type="submit" name="submit" value="Upload File" class="classname">
                    Upload File(s)
                </button>
            </form>
        </div>
    </div>
    <center><a class="btn btn-primary" href="{{ route('admin.order', $order_id) }}"><i class="fa fa-search-o fa-fw"></i>View Project</a></center>
</div>
@stop
