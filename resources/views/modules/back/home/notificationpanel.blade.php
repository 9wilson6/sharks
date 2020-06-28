<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bell fa-fw"></i> Notifications Panel
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        @foreach($notifications as $noti)
        <button class="btn btn-primary">{{ $noti->description }}</button><p></p>
        @endforeach
    </div>
    <!-- /.panel-body -->
</div>
