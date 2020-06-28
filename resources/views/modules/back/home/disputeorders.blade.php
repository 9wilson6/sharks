<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-clock-o fa-fw"></i> Active Disputes
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <!-- <i>No Recent Projects</i>  -->
        <table class="table table-striped table-hover">
            <tbody>                
                @if(count($disputed) < 1)
                <tr>
                    <em>There are no disputes yet</em>
                </tr>
                @else
                     <tr>
                        <th scope="col">Order #</th>
                        <th scope="col">Title</th>
                        <th scope="col">Deadline</th>
                        <th scope="col">Status</th>
                        <th scope="col">Bids </th>
                        <th scope="col"></th>
                    </tr>
                @endif
                @foreach($disputed as $dispute)
                    <tr>
                        <td>{{ $dispute->id }}</td>
                        <td><a href="{{ url('/account/scholarview') }}/{{ $dispute->id }}">{{ $dispute->subject }}</a></td>
                        <td>{{ $dispute->homedate }}</td>
                        <td>
                            @if($dispute->status == 1)
                              Active
                            @elseif($dispute->status == 2)
                              Cancelled
                            @elseif($dispute->status == 3)
                              Disputed
                            @elseif($dispute->status == 4)
                              In progress
                            @elseif($dispute->status == 8)
                              In Revision
                            @elseif($dispute->status == 5)
                              Completed
                            @elseif($dispute->status == 6)
                              Closed
                            @elseif($dispute->status == 7)
                              Refunded
                            @endif
                        </td>
                        <td>1</td>
                        <td><a class="btn btn-primary" href="{{ url('/account/scholarview') }}/{{ $dispute->id }}">Details</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $disputed->links() }}
    </div>
    <!-- /.panel-body -->
</div>
