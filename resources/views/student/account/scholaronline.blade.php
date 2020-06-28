@extends('layouts.masterback')
@section('title', 'Homework Bubble: Scholars Available to Chat')
@section('heading', 'Scholars Available to Chat')
@section('content')
    <div class="col-lg-12">
        <div class="panel-body">
            <table class='table table-bordered table-hover table-striped'>
                <tr>
                    <th>Scholar</th>
                    <th>Rating</th>
                </tr>
                @foreach($scholars as $scholar)
                <tr>
                    <td>
                    <strong>{{ $scholar->name }}</strong>
                        <br>
                        <a class="btn btn-success" href="javascript:void(0)" onclick="javascript:jqcc.cometchat.chatWith({{ $scholar->id }});">Chat I'm Online</a>
                    </td>
                    <td>
                        <img src="{{ asset('img/5stars.png') }}" /> <strong>{{ $scholar->tutorlevel }}</strong>
                        <br /><b>{{ $scholar->tutorratings }}</b> reviews
                        </a>
                        <br />
                        <a class="btn btn-primary btn-xs" href="{{ route('student.scholarprofile', $scholar->id) }}"> View Profile</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop