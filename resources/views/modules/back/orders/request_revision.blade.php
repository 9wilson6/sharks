<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-clock-o fa-fw"></i> Request Revision
    </div>
    <div class="panel-body">
        <form name="form" method="post" action="{{ url('/account/request-revision') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" value="{{ $order_id->id }}" name="order_id">
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <td>Project #</td>
                    <td>{{ $order_id->subject }}</td>
                </tr>
                <tr>
                    <td>Time provision</td>
                    <td>
                        <input type='text' class="form-control" name="provision" id="provision" required />                        
                    </td>
                </tr>                
                <tr>
                    <td>Instruction</td>
                    <td>
                        <div>
                            <textarea name="instruction" id="instruction" class="form-control"></textarea>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Upload additional files <small style="color: green;"><em>(You can select multiple files)</em></small></td>
                    <td>
                        <div>
                            <div class="form-group">
                                <input type="file" class="form-control" name="upload">
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <button class="btn btn-danger" type="submit" name="submit" value="Submit">Request revision</button>
        </form>
    </div>
</div>
