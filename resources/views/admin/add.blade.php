<h2>Add tutor</h2>
<form action="{{ route('admin.tutors.store') }}" method="post">
    {{ csrf_field() }}
    <div class="form-control">
        <input type="text" name="name" id="name" placeholder="Username">
    </div>
    <div class="form-control">
        <input type="text" name="fullname" id="fullname" placeholder="Full name">
    </div>
    
    <div class="form-control">
        <input type="text" name="email" id="email" placeholder="Email">
    </div>
    
    <div class="form-control">
        <input type="text" name="password" id="password" placeholder="Password">
    </div>

    <div class="form-control">
        <input type="text" name="confirm_password" id="confirm_password" placeholder="Confirm password">
    </div>

    <div class="form-control">
        <input type="checkbox" name="sendemail" id="sendemail" value="yes">
    </div>
    <button type="submit"> Create user</button>
</form>