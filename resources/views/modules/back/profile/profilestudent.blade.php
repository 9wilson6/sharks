<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-clock-o fa-fw"></i> Profile Details
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th>Quick Stats</th>
                <th></th>
            </tr>
            <tr>
                <td>Projects Posted</td>
                <td>{{ $posted }}</td>
            </tr>
            <tr>
                <td>Projects Awarded</td>
                <td>{{ $awarded }}</td>
            </tr>
            <tr>
                <tr>
                    <td>Projects Disputed</td>
                    <td>{{ $disputed }}</td>
                </tr>
                <tr>
                    <td>Refunds Issued</td>
                    <td>{{ $refunded }}</td>
                </tr>
        </table>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-bar-info-o fa-fw"></i> Reviews
        </div>
        <div class="panel-body">            
            @foreach($reviews as $review)
                <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <td><b>Review</b></td>
                        <td>Recommend</td>
                        <td>Order number</b></td>
                        <td>Comments</td>
                    </tr>
                    <tr>
                        <td><b>{{ $review->rating }}</b></td>
                        <td>{{ $review->recommend }}</td>
                        <td>{{ $review->rateable_id }}</td>
                        <td>{{ $review->comments }}</td>
                    </tr>
                </table>
            @endforeach            
        </div>
        <!-- End Panel Body -->
    </div>
    <!-- /.panel -->
</div>
