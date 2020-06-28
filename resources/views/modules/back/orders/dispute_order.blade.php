<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-clock-o fa-fw"></i> Dispute homework
    </div>
    <div class="panel-body">
        <p>
            <i>You have 24 hours to withdraw the dispute</i>
            <br />
            <i>If you do not resolve your issues with the scholar within 24 hours, we will refund you your money within 48 hours</i>
            <br />
            <b>Please provide a detailed reason why you want to dispute this order.</b>
        </p>
        <form method="post" action="{{ url('/account/dispute-order') }}">
        {{ csrf_field() }}
            <table class="table table-bordered table-hover table-striped">
                <input type="hidden" name="order_id" value="{{ $order_id->id }}">
                <tr>
                    <td>Reason for Dispute: </td>
                    <td>
                        <textarea class="form-control" name="reason" id="reason"></textarea>
                    </td>
                </tr>
            </table>
            <button onclick="return confirm('Do you really want to Dispute this order??');" class="btn btn-danger" type="submit">
                Dispute Order
            </button>
        </form>
    </div>
</div>
<center><a class="btn btn-primary" target="_blank" href="{{ url('/account/studentview') }}/{{ $order_id->id }}"><i class="fa fa-search-o fa-fw"></i>View Project</a></center>