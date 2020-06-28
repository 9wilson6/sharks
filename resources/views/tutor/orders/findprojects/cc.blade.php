<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-clock-o fa-fw"></i> Available Orders
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th scope="col">Order #</th>
                <th scope="col">Subject</th>
                <th scope="col">Title</th>
                <th scope="col">Budget</th>
                <th scope="col">Posted</th>
                <th scope="col">Bids</th>
            </tr>
            @foreach($projects as $project)
                <tr>
                    <td>
                    @if($account->hasbid(Auth::user()->id, $project->id))
                        <i data-toggle="tooltip" data-placement="top" title="You have placed a bid for this order" class="icon fa fa-check" style="color:green"></i>
                    @endif
                        <strong><a href="{{ url('/account/scholarview') }}/{{ $project->id }}">{{ $project->id }}</a></strong>
                    </td>
                    <td><strong><a href="{{ url('/account/scholarview') }}/{{ $project->id }}">{{ $project->title }}</a></strong></td>
                    <td>{{ $project->subject }}</td>
                    <td>{{ $project->budget }}</td>
                    <td>{{ $project->homedate }}</td>
                    <td>{{ $account->no_bid($project->id) }}</td>
                </tr>
            @endforeach                        
        </table>
        {{ $projects->links() }}
    </div>
</div>
