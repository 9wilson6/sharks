@extends('layouts.masterback')
@section('heading', 'Send new message to Support')
@section('content')
    @if (session('status'))
        <div class="alert alert-danger">
           <strong>{{ session('status') }}</strong>
        </div>
    @endif   
    <form action="{{ route('student.messages.supportstore') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="col-md-12">
            <!-- Send Message to -->
            <div class="form-group">
                <label class="control-label">Send message to</em></label>
                <input type="text" class="form-control" name="recipient" value="Support" disabled>
            </div>
            <!-- Subject Form Input -->
            <div class="form-group">
                <label class="control-label">Subject</label>
                <input type="text" class="form-control" name="subject" placeholder="Subject" value="{{ old('subject') }}" required>
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