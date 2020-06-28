<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bell fa-fw"></i> My Stats
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="list-group">
            <a href="#" class="list-group-item">
                <i class="fa fa-tasks fa-fw"></i> Account Balance:
                <span class="pull-right text-muted small"><em>$ {{ number_format($totalamount, 2) }}</em>
                                        </span>
            </a>
            <a href="#" class="list-group-item">
                <i class="fa fa-tasks fa-fw"></i> Orders Awarded:
                <span class="pull-right text-muted small"><em>{{ $awarded }}</em>
                                        </span>
            </a>
            <a href="#" class="list-group-item">
                <i class="fa fa-tasks fa-fw"></i> Orders Disputed:
                <span class="pull-right text-muted small"><em>{{ $disputedd }}</em>
                                        </span>
            </a>
        </div>
        <!-- /.list-group -->
    </div>
    <!-- /.panel-body -->
</div>
