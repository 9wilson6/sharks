<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><strong>Bidding settings</strong></h3>
    </div>
    <div class="panel-body">
        <form id="telegramUpdateForm" action="{{ route('admin.settings.updatetelegram') }}" method="POST" class="form-horizontal" role="form" style="padding: 10px;">
            @csrf
            <div class="form-group">
                <label for="enabletelegram">Enable Telegram Notifications</label>
                <select name="enabletelegram" id="enabletelegram" class="form-control" required="required">
                    <option @if(defaultsettings()['enabletelegram'] == 'Yes') selected="selected" @endif value="Yes">Yes</option>
                    <option @if(defaultsettings()['enabletelegram'] == 'No') selected="selected" @endif value="No">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="telegramchatid">Telegram Chat Id</label>
                <input type="text" name="telegramchatid" id="telegramchatid" value="{{ defaultsettings()['telegramchatid'] }}" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>