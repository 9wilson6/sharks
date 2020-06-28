<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-info fa-fw"></i> Project Status
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <td>Posted By</td>
                <td>{{ $order_id->student_id }}</td>
            </tr>
            <tr>
                <td>Expected Completion (Pacific Time)</td>
                <td>{{ $order_id->homedate }}</td>
            </tr>
            <tr>
                <td>Agreed Amount:</td>
                <td>$22</td>
            </tr>
        </table>
    </div>
</div>
