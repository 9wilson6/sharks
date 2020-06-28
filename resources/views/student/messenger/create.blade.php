@extends('layouts.masterback')
@section('heading', 'Send new message to '.$user->name)
@section('content')
    @if (session('status'))
        <div class="alert alert-danger">
           <strong>{{ session('status') }}</strong>
        </div>
    @endif   
    <form action="{{ route('student.messages.store', $user->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="col-md-12">
            <!-- Send Message to -->
            <div class="form-group">
                <label class="control-label">Send message to</em></label>
                <input type="text" class="form-control" name="recipient" value="{{ $user->name }}" disabled>
            </div>
            <!-- Subject Form Input -->
            <div class="form-group">
                <label class="control-label">Subject</label>
                <input type="text" class="form-control" name="subject" value="{{ old('subject') }}" placeholder="Type your order number here" required>
            </div>
            <!-- Message Form Input -->
            <div class="form-group">
                <label class="control-label">Message</label>
                <textarea name="message" class="form-control" required>{{ old('message') }}</textarea>
            </div>

            <div class="form-group">
                <label class="control-label">Upload File</label>
                <input type="file" class="form-control" name="message_file">
            </div>   
            <!-- Submit Form Input -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary form-control">Submit</button>
            </div>
        </div>
    </form>
@stop