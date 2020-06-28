<div class="col-lg-12">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <td>User</td>
                <td>{{ Auth::user()->name }}</td>
            </tr>
            <tr>
                <td>Email </td>
                <td>{{ Auth::user()->email }}</td>
            </tr>
            <tr>
                <td>Date Registered</td>
                <td>{{ Auth::user()->created_at }}</td>
            </tr>
        </table>
        <!-- InstanceEndEditable -->
    </div>
</div>
