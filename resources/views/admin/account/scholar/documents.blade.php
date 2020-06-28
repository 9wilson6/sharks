<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-info-o fa-fw"></i> <strong>Tutor documents</strong>
    </div>
    <div class="panel-body">
        <div class="col-sm-12">
            <ol>
                @foreach ($userdetails->attachments as $attach)
                    <li><a href="{{ route('admin.tutors.download', [$attach->id, $userdetails->id]) }}">{{ $attach->filename }}</a></li>                                
                @endforeach                            
            </ol>
        </div>
    </div>
</div>
