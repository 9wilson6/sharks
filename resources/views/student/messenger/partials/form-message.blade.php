<h2>Add a new message</h2>
<form action="{{ route('student.messages.update', $thread->id) }}" method="post" enctype="multipart/form-data">
    {{ method_field('put') }}
    {{ csrf_field() }}        
    <!-- Message Form Input -->
    <div class="form-group">
        <textarea name="message" required class="form-control">{{ old('message') }}</textarea>
    </div>    
    <div class="form-group">
        <label class="control-label">Upload File</label>
        <input type="file" class="form-control" name="message_file">
    </div>    
    <!-- Submit Form Input -->
    <div class="form-group">
        <button type="submit" class="btn btn-primary form-control">Submit</button>
    </div>
</form>