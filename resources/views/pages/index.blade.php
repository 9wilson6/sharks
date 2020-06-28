@extends('layouts.test')
@section('title', 'Myhomeworkshark: Homeworkhelp for students')
@section('content')
<!-- Start intro -->
@include('modules.front.intro')
<!--intro section end-->
@include('modules.front.features')
<!--end features section-->
<!--end showcase section-->
@include('modules.front.testimonials')
<!--end testimonials section-->
@include('modules.front.howitworks')
<!--end steps-->
@include('modules.front.whyus')
<div class="cta-skin">
    <div class="container text-center">
        <h2>Are you interested in becoming a tutor?</h2>
        <p>Get started now. Easy steps.</p>
        <a href="{{ url('/become-a-tutor') }}" class="btn btn-rounded btn-white-border">Create a tutor account</a>
    </div>
</div>
@stop
@section('hlinks')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
@stop
@section('scripts')
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>
    <script>
        $(function () {
            $('#homedate').datetimepicker({
                format: 'YYYY-MM-DD hh:mm:ss'
            });
        });
    </script>
@stop