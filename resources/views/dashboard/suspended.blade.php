<div class="panel-body">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th scope="col">Tutor username</th>
                <th scope="col">Email</th>
                <th scope="col">Created</th>
                <th scope="col">Awarded</th>
                <th scope="col">Disputed</th>
                <th scope="col">Balance</th>
                <th scope="col">Actions</th>
            </tr>
            @foreach($data['suspends'] as $user)
            <tr>
                <td><a href="{{ route('admin.scholarprofile', $user->id) }}"><strong>{{ $user->name }}</strong></a></td>
                <td>{{ $user->email }}</td>
                <td>{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
                <td><a href="{{ route('admin.tutors.awarded', $user->id) }}"><strong>({{ $user->orderawards->count() }}) view</strong></a></td>
                <td><a href="{{ route('admin.tutors.disputed', $user->id) }}"><strong>({{ $user->disputedorders->count() }}) view</strong></a></td>
                <td><strong> <i class="fa fa-money fa-fw"></i> $ {{ number_format($user->tutorpayments->sum('amount') - $user->tutorwithdrawals->sum('amount'), 2) }}</strong></td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('admin.tutors.edit', $user->id) }}" type="button" class="btn btn-sm btn-success"><strong>Edit</strong></a>
                        @if ($user->status != 1)
                            <a href="{{ route('admin.tutors.unsuspend', $user->id) }}" onclick="return confirm('You are about to unsuspend this tutor. Are you sure?');" type="button" class="btn btn-sm btn-primary"><strong>Unsuspend</strong></a>
                        @else
                            <a href="{{ route('admin.tutors.suspend', $user->id) }}" onclick="return confirm('Are you sure you want to suspend this tutor?, tutor will not be able to log in again after log out');" type="button" class="btn btn-sm btn-warning"><strong>Suspend</strong></a>
                        @endif
                        @if(Auth::user()->hasRole('superadmin'))
                            <a href="{{ route('admin.tutors.payments', $user->id) }}" type="button" class="btn btn-sm btn-default"><strong>Payments</strong></a>
                            <a href="{{ route('admin.tutors.delete', $user->id) }}" onclick="return confirm('Are you sure you want to delete this tutor? This action is not reversible, consider unverifying the tutor instead');" type="button" class="btn btn-sm btn-danger"><strong>Delete</strong></a>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>