<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ url('/account') }}">
            <img src="{{ asset('img/mshark.png') }}" width="168px" height="42px" alt="" class="logo-default img-responsive">
            <img src="{{ asset('img/mshark.png') }}" width="84px" height="21px" alt="" class="logo-scroll img-responsive">
        </a>
    </div>
    <!-- /.navbar-header -->
    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <img width="40" height="40" style="border-radius: 50%;" src="{{ asset(auth()->user()->image ?? '/img/noprofile.png') }}" alt="{{ Auth::user()->name }}">
                {{ Auth::user()->name }} 
                <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="{{ url('/account/profile') }}"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="{{ url('/account/changepass') }}"><i class="fa fa-gear fa-fw"></i> Change Password</a>
                </li>
                <li class="divider"></li>
                @if (Session::get('hasClonedUser') == 1)
                    <a href="#" class="btn btn-xs btn-warning" onclick="event.preventDefault(); document.getElementById('cloneuser-form').submit();"><strong>Return</strong></a>
                    <form id="cloneuser-form" action="{{ route('admin.loginas') }}" method="post">
                        {{ csrf_field() }}
                    </form>
                    <li class="divider"></li>
                @endif
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->
    <div class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="{{ url('/account') }}"><i class="fa fa-dashboard fa-2x"></i><h4>Home</h4></a>
                </li>
                <li>
                    <a href="{{ url('/messages') }}"><i class="fa fa-envelope fa-2x"></i> <h4>Messages @include('messenger.unread-count')</h4></a>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="{{ url('/account/orders') }}"><i class="fa fa-bar-chart-o fa-2x"></i><h4>Orders</h4></a>
                </li>
                <li>
                    <a href="{{ url('/account/payments') }}"><i class="fa fa-dollar fa-2x"></i><h4>Payments</h4></a>
                </li>
            </ul>
            <!-- /#side-menu -->
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
