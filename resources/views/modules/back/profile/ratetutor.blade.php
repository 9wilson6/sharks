<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-clock-o fa-fw"></i> Rate a Student
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <td>Project #</td>
                <td>{{ $order->id }}</td>
            </tr>
            <tr>
                <td>Project Title</td>
                <td><a href="{{ url('/account/studentview') }}/{{ $order->id }}">{{ $order->subject }}</a></td>
            </tr>
            <tr>
                <td>Student</td>
                <td>{{ $tutor->name }}</td>
            </tr>
        </table>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-clock-o fa-fw"></i> Please rate the Student
    </div>
    <div class="panel-body">
        <h5> Please rate the Project</h5>
        <i>Fields marked with * are required </i>
        <form name="form" method="post" action="{{ url('/account/rate-tutor') }}">
        {{ csrf_field() }}
            <table>
                <tr>
                    <td valign="top">
                        <p>
                            <label for="rating">Score (out of 10)*</label>
                        </p>
                    </td>
                    <td valign="top">
                        <select class="form-control" name="rating" id="rating">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Comments*</p>
                    </td>
                    <td>
                        <textarea class="form-control no_tiny" name="comments" id="comments" cols="50"></textarea>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <p>
                            <label for="recommend">Would Recommend*</label>
                        </p>
                    </td>
                    <td valign="top">
                        <select class="form-control" name="recommend" id="recommend">
                            <option value="Y">Yes</option>
                            <option value="N">No</option>
                        </select>
                    </td>
                </tr>
                <input type="hidden" name="user_id" value="{{ $tutor_id }}">
                <input type="hidden" name="order_id" value="{{ $order->id }}">

            </table>
            <center>
                <button class="btn btn-default" type="submit" name="submit" value="Submit" id="ratepayButton">Submit</button>
            </center>
        </form>
    </div>
</div>
