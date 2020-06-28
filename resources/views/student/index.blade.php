@extends('layouts.masterback')
@section('title')Students: {{ defaultsettings()['sitename'] }}@endsection
@section('heading', 'All Students')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>All Students
                    <div class="btn-group pull-right">
                        <a href="{{ route('admin.clients.create') }}" class="btn btn-primary"> <i class="fa fa-edit"></i> Add Client</a>
                        <a href="{{ route('admin.clients.import') }}" class="btn btn-default"> <i class="fa fa-file"></i> Import Client</a>
                    </div>
                </h4>
            </div>
            <div class="panel-body">
                @if(session('error'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif
                @if(session('status'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong> {{ session('status') }}</strong>
                    </div>
                @endif
                <div id="tableVue" class="table-responsive">
                    <all-students></all-students>
                </div>
            </div>
        </div>
    </div>
@stop

@section('vtablesection')
    <script src="{{ asset('js/vtable.js') }}"></script>    
@endsection