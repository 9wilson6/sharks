<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-info-o fa-fw"></i> <strong>Scholar Details</strong>
    </div>    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><strong>{{ $error }}</strong></li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <td><b>Scholar</b></td>
                <td>{{ $userdetails->name }}
                    {{-- @if($acelevel == 'Level 1')
                      <img src="{{ asset('img/level1.png') }}" width="80px" height="50px">
                    @endif
                    @if($acelevel == 'Level 2')
                      <img src="{{ asset('img/level2.png') }}" width="80px" height="50px">
                    @endif
                    @if($acelevel == 'Level 3')
                      <img src="{{ asset('img/level3.png') }}" width="80px" height="50px">
                    @endif
                     @if($acelevel == 'Level 4')
                      <img src="{{ asset('img/level3.png') }}" width="80px" height="50px">
                    @endif  --}}
                    <h4>{{ $acelevel }}</h4>
                </td>
            </tr>
            <tr>
                <td><b>Balance</b></td>
                <td><a data-toggle="modal" href='#deductbalance'><strong> <i class="fa fa-money fa-fw"></i> $ {{ number_format($userdetails->tutorpayments->sum('amount') - $userdetails->tutorwithdrawals->sum('amount'), 2) }} (Deduct)</strong></a></td>
            </tr>
            <tr>
                <td><b>Average Rating</b></td>
                <td><img src="{{ asset('img/5stars.png') }}"/>
                    <br /><b>{{ number_format($tutoraverage_review, 2) }}</b> out of <b>{{ $tutor_reviews }}</b> reviews</td>
            </tr>
            <tr>
                <td><b>Payment Method</b></td>
                <td>{{ $userdetails->profile->payment_method }}</td>
            </tr>
            <tr>
                <td><b>Degree</b></td>
                <td>{{ $userdetails->profile->major }}</td>
            </tr>
            <tr>
                <td><b>Highest level</b></td>
                <td>{{ $userdetails->profile->highest_level }}</td>
            </tr>
            <tr>
                <td><b>Skills</b></td>
                <td><i>{{ $userdetails->profile->skills }}</i></td>
            </tr>
        </table>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-info-o fa-fw"></i> Scholar Details
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <td><b>Specialization</b>
                </td>
                <td>
                @foreach($subjects as $subject)
                    <br><strong>- {{ $subject->subjects }}</strong></br>
                @endforeach
                </td>
            </tr>
        </table>        
    </div>
</div>

<div class="modal fade" id="deductbalance">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><strong>Deduct or withdraw funds from tutors account</strong></h4>
            </div>
            <div class="modal-body"> 
                <form action="{{ route('admin.tutors.withdraw', $userdetails->id) }}" method="post" role="form">
                    {{ csrf_field() }}
                    <legend>Withdraw/deduct funds</legend>    
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="Amount to withdraw" required>
                    </div>
                    {{-- <div class="form-group">
                        <label for="fee">Fee</label>
                        <input type="text" class="form-control" id="fee" name="fee" placeholder="Withdrawal fee" required>
                    </div> --}}
                    <div class="form-group">
                        <label for="transaction_id">Transaction id</label>
                        <input type="text" class="form-control" id="transaction_id" name="transaction_id" placeholder="Transaction id" required>
                    </div>
                    <div class="form-group">
                        <label for="payment_method">Payment method</label>
                        <select class="form-control" name="payment_method" id="payment_method" required="required">
                            <option selected="selected" value="">Please select</option>
                            <option value="Withdraw">Withdraw</option>
                            <option value="Penaulty">Penaulty</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" required></textarea>
                    </div>
                    <button type="submit" onclick="return confirm('Are you sure you want to withdraw funds from this account? This action can not be undone');" class="btn btn-primary"> <strong><i class="fa fa-money fa-fw"></i> Withdraw funds</strong></button>
                </form>
            </div>
        </div>
    </div>
</div>