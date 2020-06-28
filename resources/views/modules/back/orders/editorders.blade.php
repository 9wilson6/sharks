<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-clock-o fa-fw"></i> Your Homework Details
    </div>
    <div class="panel-body">
        <div id="navigation3">
            <form name="form" method="post" action="{{ url('/account/editorder') }}">
            {{ csrf_field() }}
                <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <td valign="top">
                            <label for="subject">Subject</label>
                        </td>
                        <td valign="top">
                            {{ $order->subject }}
                            <input type="hidden" value="{{ $order->subject }}" name="subject">

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                <label for="example2">Date & Time Due (Pacific Time)</label>
                            </p>
                        </td>
                        <td>
                            <input type='text' class="form-control" name="homedate" id="homedate" value="{{ $order->homedate }}" />
                            <script type="text/javascript">
                            $(function() {
                                $('#homedate').datetimepicker({
                                    format: 'YYYY-MM-DD hh:mm:ss'
                                });
                            });
                            </script>
                        </td>
                    </tr>
                    <input type="hidden" value="{{ $order->id }}" name="orderid">             
                    <tr>
                        <td><b>Details</b></td>
                        <td>
                            <textarea class="form-control" name="description" cols="70" rows="20">{!! html_entity_decode($order->description) !!}</textarea>
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td>
                            <h3>You can upload files after you submit</h3>
                        </td>
                    </tr>
                </table>
                <center>
                    <button class="btn btn-primary" type="submit" value="Submit">Submit</button>
                </center>
            </form>
        </div>
    </div>
</div>
