@extends('layouts.masterback')
@section('title', 'Edit order: '.defaultsettings()['sitename'])
@section('heading', 'Edit Order')
@section('postproject')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({selector:'textarea'});</script>
@stop
@section('content')
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-clock-o fa-fw"></i> Homework Details
        </div>
        <div class="panel-body">
            <div id="navigation3">
                <form name="form" method="post" action="{{ route('admin.order.update', $order->id) }}">
                    {{ csrf_field() }}
                    <table class="table table-bordered table-hover table-striped">
                        <tr>
                            <td valign="top">
                                <label for="subject">Subject</label>
                            </td>
                            <td valign="top">
                                {{ $order->subject }}
                                <input type="hidden" value="{{ $order->subject }}" name="subject">
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <label for="subject">Title</label>
                            </td>
                            <td valign="top">
                                <input type="text" class="form-control" value="{{ $order->title }}" name="title" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    <label for="example2">Date & Time Due (Pacific Time)</label>
                                </p>
                            </td>
                            <td>
                                <div class="form-group">
                                <input type='text' class="form-control" name="homedate" id="homedate" value="{{ $order->homedate }}" required/>
                                <script type="text/javascript">
                                    $(function () {
                                        $('#homedate').datetimepicker({
                                            format: 'YYYY-MM-DD hh:mm:ss'
                                        });
                                    });

                                </script>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Details</b></td>
                            <td>
                                <textarea class="form-control" name="description" cols="70" rows="20" required>{!! html_entity_decode($order->description) !!}</textarea>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <h3>You can upload files after you submit</h3>
                            </td>
                        </tr>
                    </table>
                    <center>
                        <button class="btn btn-primary" type="submit" value="Submit">Submit</button>
                    </center>
                </form>
            </div>
        </div>
    </div>

</div>
@stop
