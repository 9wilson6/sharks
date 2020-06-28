<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@yield('title')</title>
    <!-- CSRF Token -->
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
    <script>
        window.homeworkBubble = <?php echo json_encode([ 'csrfToken' => csrf_token()]); ?>

    </script>
    <!-- This web application is developed by Quest website developers Ltd -->
    @include('includes.back.headlinks')
</head>

<body>
    <div id="wrapper">        
        @if(Auth::user()->hasRole('superadmin'))
            @include('includes.back.superadminnav')
        @endif
        @if(Auth::user()->hasRole('admin'))
            @include('includes.back.adminnav')
        @endif
        @if(Auth::user()->hasRole('tutor'))
            @include('includes.back.tutornav')
        @endif
        @if(Auth::user()->hasRole('student'))
            @include('includes.back.studentnav')
        @endif        
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
    @include('includes.back.footer')
    @yield('shareandearn')
</body>

</html>