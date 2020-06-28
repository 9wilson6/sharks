<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-info-o fa-fw"></i> Scholar Details
    </div>
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
                    @endif  --}}
                    <h4>{{ $acelevel }}</h4>
                </td>
            </tr>
            <tr>
                <td><b>Average Rating</b></td>
                <td><img src="{{ asset('img/5stars.png') }}"/>
                    <br /><b>{{ number_format($tutoraverage_review, 2) }}</b> out of <b>{{ $tutor_reviews }}</b> reviews</td>
            </tr>
            <tr>
                <td><b>Degree</b></td>
                <td>{{ $userdetails->profile->major }} <i></i></td>
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