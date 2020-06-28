<div class="panel panel-default">
    <div class="panel-heading"> <i class="fa fa-clock-o fa-fw"></i> Account Balance
    </div>
    <div class="panel-body">
        <form method="post" action="">
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <td>Account Balance:</td>
                    <td><strong>{{ number_format($totalamount, 2) }}</strong></td>
                </tr>
                <tr>
                    <td>Paypal Email</td>
                    <td><strong>{{ $paypalemail }}</strong>
            </table>
            <h3>Withdrawal History</h3>
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Email</th>
                    <th scope="col">Amount</th>
                    <th>Method</th>
                    <th scope="col">Sent</th>
                </tr>
                <!-- <tr>
                    <td>2015-10-04 23:00:09</td>
                    <td>simonkinuthia20@gmail.com</td>
                    <td>$2.85</td>
                    <td>Paypal</td>
                    <td>Y</td>
                </tr> -->                
            </table>
    </div>
</div>