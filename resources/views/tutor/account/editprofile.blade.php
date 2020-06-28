@extends('layouts.masterback')
@section('title', 'Edit Profile: '.defaultsettings()['sitename'])
@section('heading', 'Edit Profile')
@section('content')
<div class="col-lg-12">
    <div class="panel-heading">
        <i class="fa fa-bar-info-o fa-fw"></i> <a class="btn btn-default" href="{{ route('tutor.profile') }}">View profile</a>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <form method="post" action="{{ route('tutor.save') }}" role="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <td>Change profile picture</td>
                    <td>
                        <input id="avatar" type="file" class="form-control" name="avatar">
                         @if (auth()->user()->image)
                            <code>{{ auth()->user()->image }}</code>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Email</p>
                    </td>
                    <td>{{ Auth::user()->email }}</td>
                </tr>
                <tr>
                    <td>
                        <p>Payment method</p>
                        <blockquote>
                            <p>Paypal <strong>{ provide Paypal email address }</strong></p>
                        </blockquote>
                    </td>
                    <td>
                        <br>Enter Payment Method
                        <br />
                        <textarea name="payment_method" class="form-control">{{ Auth::user()->profile->payment_method }}</textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Skills (programming, writing, research, tests, math)</p>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="skills" value="{{ Auth::user()->profile->skills }}" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Highest Level of Education (High School, Associate, Bachelor, Master, Phd)</p>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="highest_level" value="{{ Auth::user()->profile->highest_level }}" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Major</p>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="major" value="{{ Auth::user()->profile->major }}" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>About me</p>
                    </td>
                    <td>
                        <pre><textarea name="about_me" class="form-control" rows="10" cols="50">{{ Auth::user()->profile->about_me }}</textarea></pre>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Scholar documents</p>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-sm" data-toggle="modal" href='#add-documents'><strong>Add documents</strong></a>
                        <p></p>
                        <ol>
                            @foreach (Auth::user()->attachments as $attach)
                                <li><a href="{{ route('tutor.attachments.download', $attach->id) }}">{{ $attach->filename }}</a> <a onclick="alert('Are you sure you want to delete the file?');" href="{{ route('tutor.attachments.delete', $attach->id) }}"><span class="text-danger"><i class="fa fa-times"></i></span></a></li>                                
                            @endforeach                            
                        </ol>
                    </td>
                </tr>
                <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <th>
                            Specialization <i>(You can only bid on these subjects)</i>
                        </th>
                        <th>Checked</th>
                    </tr>
                    <div class="input-group">
                        <input type="hidden" value="12" name="count_sub">
                        @foreach($subjects as $subject)
                        <tr>
                            <td>{{ $subject->subjects }}</td>
                            <td>
                                @if($ischecked)
                                <input type="checkbox" name="option[]" value="{{ $subject->subject }}" checked />
                                @else
                                <input type="checkbox" name="option[]" value="{{ $subject->subject }}" />
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </div>
                </table>
                <center>
                    <button name="submit" type="submit" class="btn btn-default" value="Submit">Submit</button>
                </center>
        </form>
    </div>
</div>
<div class="modal fade" id="add-documents">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><strong>Add documents</strong></h4>
            </div>
            <div class="modal-body">                    
                <form action="{{ route('tutor.attachments') }}" method="post" role="form" enctype="multipart/form-data">
                    {{ csrf_field() }}                    
                    <div class="form-group">
                        <label for="">Add multiple documents</label>
                        <input type="file" class="form-control" multiple name="attachments[]" placeholder="Add documents">
                    </div>
                    <button type="submit" class="btn btn-primary"><strong>Add Documents</strong></button>
                </form>                    
            </div>
        </div>
    </div>
</div>
@stop