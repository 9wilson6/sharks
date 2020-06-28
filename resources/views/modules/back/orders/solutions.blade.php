<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-info fa-fw"></i> Solutions
    </div>
    <p></p>
    @if(count($solutions) < 1)
       <button class="btn btn-warning"><i>Project does not have any solution</i></button>
    @endif

    @foreach($solutions as $solution)
       <a href="{{ url('/account/getsolution') }}/{{ $solution->filename }}/{{ $order_id->id }}" class="btn btn-danger">{{ $solution->original_filename }}</a>
    @endforeach    
    <p></p>
</div>
