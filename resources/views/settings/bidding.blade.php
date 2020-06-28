<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><strong>Bidding settings</strong></h3>
    </div>
    <div class="panel-body">
        <form id="biddingSettingsUpdate" action="{{ route('admin.settings.updatebidding') }}" method="POST" class="form-horizontal" role="form" style="padding: 10px;">
            @csrf
            <div class="form-group">
                <label for="release_grace">Grace period to release funds</label>
                <select name="release_grace" id="release_grace" class="form-control" required="required">
                    <option @if(defaultsettings()['release_grace'] == '2') selected="selected" @endif value="2">2</option>
                    <option @if(defaultsettings()['release_grace'] == '5') selected="selected" @endif value="5">5</option>
                    <option @if(defaultsettings()['release_grace'] == '7') selected="selected" @endif value="7">7</option>
                    <option @if(defaultsettings()['release_grace'] == '10') selected="selected" @endif value="10">10</option>
                    <option @if(defaultsettings()['release_grace'] == '14') selected="selected" @endif value="14">14</option>
                    <option @if(defaultsettings()['release_grace'] == '20') selected="selected" @endif value="20">20</option>
                    <option @if(defaultsettings()['release_grace'] == '30') selected="selected" @endif value="30">30</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>