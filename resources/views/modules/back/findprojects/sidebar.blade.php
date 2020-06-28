<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-clock-o fa-fw"></i> Filter By Subject
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <td><a href="{{ url('/account/findprojects') }}"> All subjects</a></td>
            </tr>
            @foreach($subjects as $subject)
                <tr>
                    <td><a href="{{ url('/account/findprojects') }}"> {{ $subject->subjects }}</a></td>
                </tr>
            @endforeach                        
        </table>
    </div>
</div>