<div class="panel panel-default">
    <div class="panel-body">
        @if($order_id->status == 1)    
            <div class="col-lg-3">
                <a href="{{ url('/account/scholaronline') }}" class="btn btn-success btn-block">Chat With Scholars</a>
            </div>
        @endif

        @if($order_id->status == 1 OR $order_id->status == 4 OR $order_id->status == 5)    
            <div class="col-lg-3">
                <a href="{{ url('/account/upload-files') }}/{{ $order_id->id }}" class="btn btn-primary btn-block">Upload Files</a>
            </div>
        @endif 

        @if($order_id->status == 1 OR $order_id->status == 4)    
            <div class="col-lg-3">
                <a href="{{ url('/account/edit-order') }}/{{ $order_id->id }}" class="btn btn-warning btn-block">Edit your Order</a>
            </div>
        @endif 

        @if($order_id->status == 1)    
            <div class="col-lg-3">
                <a href="{{ url('/account/cancel-order') }}/{{ $order_id->id }}" class="btn btn-danger btn-block">Cancel Order</a>
            </div>
        @endif 
    </div>
</div>
