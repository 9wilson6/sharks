<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-info fa-fw"></i> Actions
    </div>
    <div class="panel-body">
        @if($order_id->status == 4 OR $order_id->status == 5 OR $order_id->status == 3)    
            <div class="col-lg-2">
                <a href="javascript:void(0)" class="btn btn-success btn-block" onclick="javascript:jqcc.cometchat.chatWith('57');">Chat Now!</a>
            </div>
        @endif

        @if($order_id->status == 3 OR $order_id->status == 4 OR $order_id->status == 5 OR $order_id->status == 6)    
            <div class="col-lg-2">
                <a href="{{ url('/messages/create') }}/{{ $order_id->tutor_id }}" class="btn btn-primary btn-block">Message</a>
            </div>
        @endif

        @if($order_id->status == 5)    
            <div class="col-lg-2">
                <a onclick="return confirm('Do you really want to Release Payment?');" href="{{ url('/account/release-payment') }}/{{ $order_id->id }}" class="btn btn-warning btn-block">Release payment</a>
            </div>
        @endif

        @if($order_id->status == 5)    
            <div class="col-lg-2">
                <a href="{{ url('/account/requestrevision') }}/{{ $order_id->id }}" class="btn btn-danger btn-block">Request revision</a>
            </div>
        @endif        

        @if($order_id->status == 5  OR $order_id->status == 3  OR $order_id->status == 6)    
            @if($tutorrated == 0)    
                <div class="col-lg-2">
                    <a href="{{ url('/account/ratetutor') }}/{{ $order_id->tutor_id }}/{{ $order_id->id }}" class="btn btn-warning btn-block">Review scholar</a>
                </div>
            @endif
        @endif

        @if($order_id->status == 5 OR $order_id->status == 3)
            @if($isdisputed == 0)    
                <div class="col-lg-2">
                    <a href="{{ url('/account/disputeorder') }}/{{ $order_id->id }}" class="btn btn-danger btn-block">Request refund</a>
                </div>
            @else
                <div class="col-lg-2">
                    <a href="{{ url('/account/withdrawdispute') }}/{{ $order_id->id }}" class="btn btn-danger btn-block">Withdraw Dispute</a>
                </div>
            @endif            
        @endif

        @if($order_id->status == 4 OR $order_id->status == 5 OR $order_id->status == 6 OR $order_id->status == 7)
            @if(!$awarded->isfavorite($order_id->awarded_to))    
                <div class="col-lg-2">
                    <a href="{{ url('/account/add-favorite') }}/{{ $order_id->student_id }}/{{ $order_id->awarded_to }}" class="btn btn-primary btn-block">Add Favorite</a>
                </div>           
            @endif            
        @endif
    </div>
    <div class="panel-footer">
        <i class="fa fa-info fa-fw"></i> <p class="text-danger">Reasons for Dispute: {{ $disputes['reason'] }}</p>
        <p class="text-danger">Time remaining before order escalates: {{ \Carbon::now()->addHours(24)->diffForHumans(); }}</p>
    </div>
</div>
