<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-clock-o fa-fw"></i> Proposal Information
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped">
        @if(count($scholars) < 1)
        <em>No Favorite Scholars Yet</em>
        @else
            <tr>
                <th scope="col">Scholar name # </th>
                <th scope="col">Awarded orders</th>
                <th scope="col">Chat With Scholar</th>
                <th scope="col">Send Message</th>
            </tr>
            @foreach($scholars as $scholar)  
                <tr>
                    <td><a href="{{ url('account/scholarprofile') }}/{{ $scholar->id }}"><strong>{{ $user->getusername($scholar->tutor_id) }}</strong></a></td>
                    <td>{{ $awarded->totalorders($scholar->tutor_id, $scholar->student_id) }}</td>
                    <td>

                    <!-- <button class="btn btn-success">Chat Now</button> -->
                    <button class="btn btn-success" disabled="disabled">Not Available</button>

                    </td>
                    <td><a class="btn btn-primary" href="{{ url('/messages/create') }}/{{ $scholar->tutor_id }}">Send Message</a></td>
                </tr>
            @endforeach  

        @endif          
        </table>
    </div>
</div>