<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th scope="col">Order #</th>
            <th scope="col">Tutor</th>
            <th scope="col">Student</th>
            <th scope="col">Order Amount</th>
            <th scope="col">Order Created</th>
            <th scope="col">Actions</th>
        </tr>
        @foreach($data['manualreleases'] as $release)
        <tr>
            <td><strong><a href="{{ route('admin.order', $release->order_id) }}">{{ $release->order_id }}</a></strong></td>
            <td><a href="{{ route('admin.scholarprofile', $release->order->tutor->id) }}">{{ $release->order->tutor->name }}</a></td>
            <td><a href="{{ route('admin.studentprofile', $release->order->student->id) }}">{{ $release->order->student->name }}</a></td>
            <td>${{ $release->order->agreed_amount }}</td>
            <td>{{ \Carbon\Carbon::parse($release->order->created_at)->diffForHumans() }}</td>
            <td>
                <div class="btn-group">
                    <a href="{{ route('admin.order', $release->order_id) }}" type="button" class="btn btn-xs btn-primary"><strong>Order details</strong></a>
                    @if ($release->released === 1)
                        <button type="button" class="btn btn-xs btn-success"><strong>Released</strong></button>
                    @else
                        <a href="{{ route('admin.manualreleases.approve', $release->id) }}" type="button" class="btn btn-xs btn-info" onclick="return confirm('Are you sure you want to release payment for this order?');"><strong>Release Payment</strong></a>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </table>
</div>