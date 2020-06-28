@extends('layouts.masterback')
@section('heading') Create a new message @stop

@section('content')
    @if (session('status'))
        <div class="alert alert-danger">
           <strong>{{ session('status') }}</strong>
        </div>
    @endif   
    <form action="{{ route('messages.store') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="col-md-12">
            @if($admin == 'nothing')
            <!-- Send Message to -->
            <div class="form-group">
                <label class="control-label">User <em>(Username will be autocompleted)</em></label>
                <input type="hidden" name="autocompleted" value="yes">
                <input type="text" class="form-control" id="q" name="recipients" placeholder="Enter name">
            </div>
            @endif
            <!-- Subject Form Input -->
            <div class="form-group">
                <label class="control-label">Subject</label>
                <input type="text" class="form-control" name="subject" placeholder="Subject"
                       value="{{ old('subject') }}">
            </div>

            <!-- Message Form Input -->
            <div class="form-group">
                <label class="control-label">Message</label>
                <textarea name="message" class="form-control">{{ old('message') }}</textarea>
            </div>

            <div class="form-group">
                <label class="control-label">Upload File</label>
                <input type="file" class="form-control" name="message_file">
            </div>
            @if($admin == 'yes')
                <div class="checkbox">
                    <label title="Administrator">
                        <input type="checkbox" disabled="disabled" checked="checked">Administrator
                        <input type="hidden" name="recipients" value="{{ $users->id }}">
                        <input type="hidden" name="autocompleted" value="no">
                    </label>                        
                </div>
            @endif
            @if($admin == 'no')
                <div class="checkbox">
                    <label title="{{ $users->name }}">
                    <input type="hidden" name="recipients" value="{{ $users->id }}">
                        <input type="hidden" name="autocompleted" value="no">
                        <input type="checkbox" disabled="disabled" checked="checked">{{ $users->name }}
                    </label>                        
                </div>
            @endif    
            <!-- Submit Form Input -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary form-control">Submit</button>
            </div>
        </div>
    </form>
@stop

@section('autocomplete')
<script>
    $(function()
        {
             $( "#q" ).autocomplete({
              source: "{{ url('/search/autocomplete') }}",
              minLength: 3,
              select: function(event, ui) {
                $('#q').val(ui.item.value);
              }
            });
    });
</script>
@stop
