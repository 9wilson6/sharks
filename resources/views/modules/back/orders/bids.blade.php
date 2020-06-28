<div class="panel panel-default">
    <div class="panel-heading"> <i class="fa fa-info fa-fw"></i> Scholars Bids
    </div>
    <div class="panel-body bidsmuya">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th>Scholar</th>
                <th>Rating</th>
                <th>Bid Amt + 10% fee</th>
                <th>Completion Time (Pacific Time)</th>
            </tr>
            @foreach($bids as $bid)
                <tr>
                    <td>
                        <a href="{{ url('account/scholarprofile') }}/{{ $bid->tutor_id }}">{{ $user->getusername($bid->tutor_id) }}</a>
                    </td>
                    <td>
                        <a href="{{ url('account/scholarprofile/') }}/{{ $bid->tutor_id }}">
                            <img src="{{ asset('img/4halfstars.png') }}" /> {{ $rating }} reviews
                        </a>
                    </td>
                    <td>
                        <strong>${{ $bid->amount }}</strong>
                        <a onclick="return confirm('Do you really want to Delete this bid?');" href="{{ url('account/delete-bid/') }}/{{ $bid->id }}"><strong>Delete bid</strong></a>
                    </td>
                    <td>{{ $bid->homedate }}</td>
                </tr>
            @endforeach            
        </table>
    </div>
</div>
<script>
    setInterval(function(){
        $.ajax({
            type: "POST",
            url: "/account/scholarview/"+@{{ $bid->id }},
            success:function(bids)
            {
                $(".bidsmuya").html(bids);
            }
        });
    },5000);
</script>