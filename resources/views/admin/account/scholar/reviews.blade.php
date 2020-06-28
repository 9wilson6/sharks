<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-info-o fa-fw"></i> <strong>Reviews</strong>
    </div>
    <div class="panel-body">
        @foreach($reviews as $review)
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <td><b>Reviews</b></td>
                <td><a data-toggle="modal" href='#editReview-{{ $review->id }}' class="btn btn-sm btn-success"><strong> <i class="fa fa-edit"></i> Edit</strong></a></td>
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
                <td>Publishable?</td>
                <td>{{ $review->publish == 1 ? 'Yes' : 'No' }}</td>
            </tr>
            <tr>
                <td>Rating</td>
                <td>{{ $review->rating }}</td>
            </tr>
        </table>
        <div class="modal fade" id="editReview-{{ $review->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><strong>Modify Rating for order #{{ $review->order_id }}</strong></h4>
                    </div>
                    <div class="modal-body">
                        <h5> Please rate the Project</h5>
                        <i>Fields marked with * are required </i>
                        <form name="form" method="post" action="{{ route('admin.ratings.edit', $review->id) }}">
                            @csrf
                            <table>
                                <tbody>
                                    <tr>
                                        <td valign="top">
                                            <p>
                                                <label for="rating">Score (out of 10)*</label>
                                            </p>
                                        </td>
                                        <td valign="top">
                                            <select class="form-control" name="rating" id="rating">
                                                @for ($i = 1; $i < 11; $i++)
                                                    <option @if($review->rating == $i) selected="selected" @endif value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Comments*</p>
                                        </td>
                                        <td>
                                            <textarea class="form-control no_tiny" name="comments" id="comments" cols="50">{{ $review->comments }}</textarea>
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
                                                <option @if($review->recommend == 'Yes') selected="selected" @endif value="Yes">Yes</option>
                                                <option @if($review->recommend == 'No') selected="selected" @endif value="No">No</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">
                                            <p>
                                                <label for="publish">Is review publishable*</label>
                                            </p>
                                        </td>
                                        <td valign="top">
                                            <select class="form-control" name="publish" id="publish">
                                                <option @if($review->publish == true) selected="selected" @endif value="1">Yes</option>
                                                <option @if($review->publish == false) selected="selected" @endif value="0">No</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <center><button class="btn btn-default" type="submit" name="submit" value="Submit" id="ratepayButton">Edit rating</button></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        {{ $reviews->links() }}
    </div>
</div>
