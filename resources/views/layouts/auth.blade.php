<!DOCTYPE html>
<html lang="en">
    @include('includes.front.headlinks')
    <!-- CSRF Token -->
    <?php
    $pushers = \App\Pusher::where('id', 1)->get();
    if ($pushers->isEmpty()) {
        $p = [
        'app_key' => '5b9b8b46e4e2b5ff8706',
        'app_cluster' => 'mt1'
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
        window.myhomeworkShark =  <?php echo json_encode([ 'csrfToken' => csrf_token()]); ?>
    </script>
    <body class="page-misc">
        <!--navbar end-->
          @yield('content')
        @include('includes.front.footerlinks')
    </body>
</html>