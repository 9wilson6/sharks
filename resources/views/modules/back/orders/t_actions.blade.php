<div class="panel-body">
    @if($order_id->status == 4 OR $order_id->status == 5 OR $order_id->status == 3)
    <div class="col-lg-2">
        <a href="javascript:void(0)" class="btn btn-success btn-block" onclick="javascript:jqcc.cometchat.chatWith('57');">Chat Now!</a>
    </div>
    @endif
    @if($order_id->status == 1 OR $order_id->status == 4 OR $order_id->status == 5 OR $order_id->status == 3)
    <div class="col-lg-2">
        <a href="{{ url('/messages/create') }}/{{ $order_id->student_id }}" class="btn btn-primary btn-block">Message</a>
    </div>
    @endif
    @if($order_id->status == 1 OR $order_id->status == 4 OR $order_id->status == 5)
    <div class="col-lg-2">
        <a href="#" class="btn btn-success btn-block">Bookmark Project</a>
    </div>
    @endif
    @if($order_id->status == 4 OR $order_id->status == 5)
    <div class="col-lg-2">
        <a href="#" class="btn btn-warning btn-block">Refund</a>
    </div>
    @endif
    @if($order_id->status == 6 OR $order_id->status == 5) @if($studentrated == 0)
    <div class="col-lg-2">
        <a href="{{ url('/account/ratestudent') }}/{{ $order_id->student_id }}/{{ $order_id->id }}" class="btn btn-warning btn-block">Review Student</a>
    </div>
    @endif
    @endif @if($order_id->status == 4 OR $order_id->status == 5)
    <div class="col-lg-2">
        <a href="{{ url('/account/uploadsolution') }}/{{ $order_id->id }}" class="btn btn-warning btn-block">Upload solution</a>
    </div>
    @endif
</div>