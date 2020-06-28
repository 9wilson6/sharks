<!-- <div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-info-o fa-fw"></i> Reviews
    </div>
    <div class="panel-body">
           @foreach($reviews as $review)
               <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <td><b>Reviews</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td>{{ $review->created_at }}</td>
                    </tr>            
                    <tr>
                        <td>Order#</td>
                        <td>{{ $review->order_id }}</td>
                    </tr>
                    <tr>
                        <td>Review</td>
                        <td>{{ $review->comments }}</td>
                    </tr>
                    <tr>
                        <td>Recommend?</td>
                        <td>{{ $review->recommend }}</td>
                    </tr>
                    <tr>
                        <td>Rating</td>
                        <td>{{ $review->rating }}</td>
                    </tr>
                </table>
            @endforeach
            {{ $reviews->links() }}            
    </div>
</div>
 -->