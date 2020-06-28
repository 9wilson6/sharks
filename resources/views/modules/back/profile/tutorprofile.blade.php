<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-info-o fa-fw"></i> <a class="btn btn-default" href="{{ url('/account/editprofile') }}">Edit Profile</a>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
            @if (session('status'))
                <div class="alert alert-success">
                    <strong>{{ session('status') }}</strong>
                </div>
            @endif
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <tr>
                            <td>User</td>
                            <td>{{ Auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <td>Email </td>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>
                        <tr>
                            <td>Date Registered</td>
                            <td>{{ Auth::user()->created_at }}</td>
                        </tr>
                        <tr>
                            <td>No. of Ratings</td>
                            <td>{{ $tutor_reviews }}</td>
                        </tr>
                        <tr>
                            <td>Average Rating</td>
                            <td>{{ number_format($tutoraverage_review, 2) }}</td>
                        </tr>
                        <tr>
                            <td>My Public Profile</td>
                            <td><a href="{{ url('/account/scholarprofile') }}/{{ Auth::user()->id }}">See My Reviews </a></td>
                        </tr>
                        <tr>
                            <td>Skills</td>
                            <td>
                                {{ Auth::user()->skills }}
                            </td>
                        </tr>
                        <tr>
                            <td>Account Balance</td>
                            <td>$ {{ number_format($totalamount, 2) }}</td>
                        </tr>
                        <tr>
                            <td>About Me</td>
                            <td><pre>{{ Auth::user()->about_me }}</pre></td>
                        </tr>                        
                        <tr>
                            <td>Payment Email / ID</td>
                            <td>
                                {{ Auth::user()->payment_email }}
                            </td>
                        </tr>
                        <tr>
                            <td>Level</td>
                            <td>
                              {{ Auth::user()->major }}</td>
                        </tr>
                        <tr>
                            <td>Email me when a new project matching my skills is posted (Only Scholars with a Rating of 9 and above will get emails)</td>
                            <td>
                            {{ Auth::user()->email_me }}
                            </td>
                        </tr>
                    </table>
                   <table>
                        <tbody>
                            <tr>
                                <th>Skills <i> (You will be emailed when a project matches the following skills)</i></th>
                            </tr>
                            @foreach($subjects as $subject)
                            <tr>
                                <td>- {{ $subject->subjects }}</td>
                            </tr> 
                            @endforeach                       
                        </tbody>
                    </table>
                    <!-- InstanceEndEditable -->
                </div>
            </div>
            <!-- /.col-lg-8 (nested) -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.panel-body -->
</div>
