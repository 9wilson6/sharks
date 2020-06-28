<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@yield('title')</title>
    <?php
        $pushers = \App\Pusher::where('id', 1)->get();
        if ($pushers->isEmpty()) {
            $p = [
                'app_key' => '8979ccbf537975ba5c02',
                'app_cluster' => 'ap3'
            ];
        } else {
            $pusher = \App\Pusher::where('id', 1)->first();
            $p = [
                'app_key' => $pusher->app_key,
                'app_cluster' => $pusher->app_cluster
            ];
        }
    ?>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="chat-echo-key" content="{{ $p['app_key'] }}">
    <meta name="chat-echo-lust" content="{{ $p['app_cluster'] }}">
    @include('includes.back.headlinks')
</head>
<body>
    <div id="wrapper">
        @include('includes.back.tutornav')
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        @yield('heading') @yield('header_id')
                    </h1>
                </div>
            </div>
            <div class="row">
                <div id="pageContent">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/tutororderdetails.js') }}"></script>
</body>

</html>
