<?php $class = $thread->isUnread(Auth::id()) ? 'alert-info' : ''; ?>
<div class="media alert {{ $class }}">
    <h4 class="media-heading">
        <u><a style="color: red;" href="{{ route('student.messages.show', $thread->id) }}">{{ $thread->subject }}
        ({{ $thread->userUnreadMessagesCount(Auth::id()) }} unread)</a></u></h4>
    <p>
        {{ $thread->latestMessage->body }}
    </p>
    <p>
        <small><strong>Sender (Message creator):</strong> {{ $thread->creator()->name }}</small>
    </p>
    <p>
        <small><strong>Receiver:</strong> {{ $thread->participantsString(Auth::id()) }}</small>
    </p>
</div>