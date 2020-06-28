<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-info-o fa-fw"></i> Contact Scholar
    </div>
    <div class="panel-body">
        <div class="col-xs-6 col-md-6">
            <a class="btn btn-danger btn-block" href="{{ route('tutor.messages.create', $userdetails->id) }}">Send a Message to Scholar</a>
        </div>
        <div class="col-xs-6 col-md-6">
            <a class="btn btn-success btn-block" href="javascript:void(0)" onclick="javascript:jqcc.cometchat.chatWith({{ $userdetails->id }});">Chat Now!</a>
        </div>
    </div>
</div>
