<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-info-o fa-fw"></i> <strong>Contact Scholar</strong>
    </div>
    <div class="panel-body">
        <div class="col-xs-4 col-md-4">
            @if ($userdetails->profile->verified === null)
                <a class="btn btn-info btn-block" href="{{ route('admin.tutors.verify', $userdetails->id) }}"><strong>Verify tutor</strong></a>                
            @else
                <a class="btn btn-warning btn-block" href="{{ route('admin.tutors.unverify', $userdetails->id) }}"><strong>Unverify tutor</strong></a>
            @endif            
        </div>
        <div class="col-xs-4 col-md-4">
            <a class="btn btn-danger btn-block" href="{{ route('admin.messages.create', $userdetails->id) }}">Send a Message</a>
        </div>
        <div class="col-xs-4 col-md-4">
            <a class="btn btn-success btn-block" href="javascript:void(0)" onclick="javascript:jqcc.cometchat.chatWith({{ $userdetails->id }});"><strong>Chat Now!</strong></a>
        </div>
    </div>
</div>
