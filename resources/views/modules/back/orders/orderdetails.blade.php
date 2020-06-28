<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bell-o fa-fw"></i> Details
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <td>Posted By</td>
                <td>
                    <a href="{{ url('/account/student-profile') }}/{{ $order_id->student_id }}">View Student Profile</a>
                </td>
            </tr>
            <tr>
                <td>Subject</td>
                <td>{{ $order_id->subject }}</td>
            </tr>
            <tr>
                <td>Level</td>
                <td>{{ $order_id->level }}</td>
            </tr>
            <tr>
                <td>Format</td>
                <td>{{ $order_id->format }}</td>
            </tr>
            <tr>
                <td>Budget</td>
                <td>{{ $order_id->budget }}</td>
            </tr>
            <tr>
                <td>Number of Pages</td>
                <td>{{ $order_id->numpages }}</td>
            </tr>
            <tr>
                <td>Duee By (Pacific Time)</td>
                <td>{{ $order_id->homedate }}</td>
            </tr>
        </table>
        <hr>
        {!!html_entity_decode($order_id->description)!!}
        <br>
        <h3>Uploaded attachements</h3>
        <hr>
        <p></p>
        @if(count($attachments) < 1)
           <button class="btn btn-warning"><i>Project does not have any Attachments</i></button>
        @endif

        @foreach($attachments as $attach)
           <a href="{{ url('/account/getattach') }}/{{ $attach->filename }}/{{ $order_id->id }}" class="btn btn-danger">{{ $attach->original_filename }}</a>
        @endforeach    
        <p></p>
    </div>
</div>
