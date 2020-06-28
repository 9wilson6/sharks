@extends('layouts.masterback')
@section('title', 'Rate Student: '.defaultsettings()['sitename'])
@section('heading', 'Rate Student')
@section('content')
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-clock-o fa-fw"></i> Rate student
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <td>Project #</td>
                    <td>{{ $orderdetails->id }}</td>
                </tr>
                <tr>
                    <td>Project Title</td>
                    <td><a href="{{ route('tutor.order', $orderdetails->id) }}">{{ $orderdetails->subject }}</a></td>
                </tr>
                <tr>
                    <td>Student name</td>
                    <td>{{ $orderdetails->student->name }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-clock-o fa-fw"></i> Please rate the student
        </div>
        <div class="panel-body">
            <h5> Please rate the Project</h5>
            <i>Fields marked with * are required </i>
            <form name="form" method="post" action="{{ route('tutor.rate.student.save', $orderdetails->id) }}">
                {{ csrf_field() }}
                <table>
                    <tr>
                        <td valign="top">
                            <p>
                                <label for="rating">Score (out of 10)*</label>
                            </p>
                        </td>
                        <td valign="top">
                            <select class="form-control" name="rating" id="rating">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Comments*</p>
                        </td>
                        <td>
                            <textarea class="form-control no_tiny" name="comments" id="comments" cols="50"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <p>
                                <label for="recommend">Would Recommend*</label>
                            </p>
                        </td>
                        <td valign="top">
                            <select class="form-control" name="recommend" id="recommend">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <center><button class="btn btn-default" type="submit" name="submit" value="Submit" id="ratepayButton">Submit</button></center>
            </form>
        </div>
    </div>
</div>
@stop
