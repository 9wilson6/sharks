<div class="panel-heading">
    <i class="fa fa-bar-info-o fa-fw"></i> <a class="btn btn-default" href="{{ url('/account/profile') }}">View Profile</a>
</div>
<!-- /.panel-heading -->
<div class="panel-body">
    <form method="post" enctype="multipart/form-data" action="{{ url('edit_account') }}">
    {{ csrf_field() }}
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <td>
                    <p>Email</p>
                </td>
                <td>{{ $useraccount->email }}</td>
            </tr>
            <tr>
                <td>
                    <p>Payment method (Please pick one only!)</p>
                </td>
                <td>
                    <br>Enter Paypal Email address below
                    <br />
                    <input class="form-control" type="text" name="payment_email" value="{{ $useraccount->payment_email }}" value="" />
                    <br />
                    <br />                    
                </td>
            </tr>
            <tr>
                <td>
                    <p>Skills (programming, writing, research, tests, math)</p>
                </td>
                <td>
                    <input type="text" class="form-control" name="skills" value="{{ $useraccount->skills }}" />
                </td>
            </tr>
            <tr>
                <td>
                    <p>Highest Level of Education (High School, Associate, Bachelor, Master, Phd)</p>
                </td>
                <td>
                    <input type="text" class="form-control" name="highest_level" value="{{ $useraccount->highest_level }}" />
                </td>
            </tr>
            <tr>
                <td>
                    <p>Major</p>
                </td>
                <td>
                    <input type="text" class="form-control" name="major" value="{{ $useraccount->major }}" />
                </td>
            </tr>
            <tr>
                <td>
                    <p>About me</p>
                </td>
                <td><pre><textarea name="about_me" class="form-control" rows="10" cols="50">{{ $useraccount->about_me }}</textarea></pre></td>
            </tr>
            <tr>
                <td>
                    <p>Email me when a new project matching my skills is posted</p>
                </td>
                <td>
                    <select class="form-control" name="email_me" id="email_me">
                        <option selected="yes" value="N">N</option>
                        <option value="Y">Y</option>
                    </select>
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
                                <input type="checkbox" name="option[]" value="{{ $subject->subject }}"/>
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
    <!-- InstanceEndEditable -->
    <!-- /.col-lg-8 (nested) -->
    <!-- /.row -->
</div>
<!-- /.panel-body -->
