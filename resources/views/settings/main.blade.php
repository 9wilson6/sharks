<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><strong>General settings</strong></h3>
    </div>
    <div class="panel-body">
        <form id="generalSettingsForm" action="{{ route('admin.settings.updatemain') }}" method="POST" class="form-horizontal" role="form" style="padding: 10px;">
            @csrf
            <div class="form-group">
                <label for="input-id">Site url</label>
                <input type="text" disabled name="siteurl" id="siteurl" value="{{ Request::root() }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="input-id">Site name</label>
                <input type="text" name="sitename" id="sitename" value="{{ defaultsettings()['sitename'] }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="input-id">Site Email</label>
                <input type="text" name="siteemail" id="siteemail" value="{{ defaultsettings()['siteemail'] }}" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>