<div class="media">
    <a class="pull-left" href="#">
        <img src="//www.gravatar.com/avatar/{{ md5($message->user->email) }} ?s=64" alt="{{ $message->user->name }}" class="img-circle">
    </a>
    <div class="media-body">
        <h5 class="media-heading">{{ $message->user->name }}</h5>
        <p>{{ $message->body }}</p>
        @if(!empty($message->filename))
        <p><a href="{{ route('student.messages.download', [$message->thread_id, $message->id, $message->filename]) }}"><strong><i class="fa fa-paperclip" aria-hidden="true"></i> There is an attachment, click to download</strong></a></p>
        @endif
        <div class="text-muted">
            <small>Posted {{ $message->created_at->diffForHumans() }}</small>
        </div>
    </div>
</div>