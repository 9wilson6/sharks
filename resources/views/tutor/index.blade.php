@extends('layouts.masterback')
@section('title', 'Tutors: '.defaultsettings()['sitename'])
@section('heading', 'All Tutors')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>All tutors <a href="{{ route('admin.tutors.create') }}" class="pull-right btn btn-primary"><strong>Add tutor</strong></a></h4></div>
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
                    <all-tutors></all-tutors>
                </div>
            </div>
        </div>
    </div>
@stop

@section('vtablesection')
    <script src="{{ asset('js/vtable.js') }}"></script>    
@endsection

