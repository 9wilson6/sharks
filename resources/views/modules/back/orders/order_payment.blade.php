<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-clock-o fa-fw"></i> Assign Project
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <td>Project Number</td>
                <td>{{ $orderdetails['order_id'] }}</td>
            </tr>
            <tr>
                <td>Scholar</td>
                <td>{{ $orderdetails['tutor'] }}</td>
            </tr>
            <tr>
                <td><b>Scholar Will Complete By (Mountain Standard Time)</b></td>
                <td><b>{{ $orderdetails['homedate'] }}</b></td>
            </tr>
            <tr>
                <td>Total Amount</td>
                <td>${{ $orderdetails['amount'] }}</td>
            </tr>
        </table>
        <p>
            <center>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                    <input type="hidden" name="cmd" value="_xclick">
                    <input type="hidden" name="business" value="admin@myhomeworkshark.com">
                    <input type="hidden" name="item_name" value="Payment for  by myhomeworkshark">
                    <input type="hidden" name="item_number" value="{{ $orderdetails['order_id'] }}">
                    <input type="hidden" name="invoice" value="">
                    <input type="hidden" name="amount" value="{{ $orderdetails['amount'] }}">
                    <input type="hidden" name="no_shipping" value="2">
                    <input type="hidden" name="return" value="http://www.myhomeworkshark.com/thankyou.php">
                    <input type="hidden" name="notify_url" value="http://www.acemyhomework.com/ipn-handler.php">
                    <input type="hidden" name="no_note" value="1">
                    <input type="hidden" name="currency_code" value="USD">
                    <input type="hidden" name="lc" value="MY">
                    <input type="hidden" name="rm" value="2">
                    <input type="hidden" name="bn" value="PP-BuyNowBF">
                    <input type="hidden" name="custom" value="1130373-N-N-0">
                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                    <br />
                </form>
            </center>
    </div>
</div>
