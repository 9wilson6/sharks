<div class="panel-body">
    <table class='table table-bordered table-hover table-striped'>
        <tr>
            <th>Scholar</th>
            <th>Rating</th>
        </tr>
        @foreach($tutors as $scholar)
        <tr>
            <td>
               <strong>{{ $scholar->name }}</strong>
                <br>
                <a class="btn btn-success" href="javascript:void(0)" onclick="javascript:jqcc.cometchat.chatWith({{ $scholar->id }});">Chat I'm Online</a>
            </td>
            <td>
                <img src="{{ asset('img/5stars.png') }}" />
                <br /><b>{{ $scholar->ratingscount }}</b> reviews
                </a>
                <br />
                <a class="btn btn-primary btn-xs" href="{{ url('/account/scholarprofile') }}/{{ $scholar->id }}"> View Profile</a>
            </td>
        </tr>
        @endforeach
    </table>
    <!-- InstanceEndEditable -->
</div>
