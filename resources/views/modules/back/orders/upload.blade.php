<form name="form" method="post" action="{{ url('/account/upload-file') }}">
    {{ csrf_field() }}
    <input type="file" name="uploads">
    
    <button type="submit" class="btn btn-danger">Place bid</button>
</form>
