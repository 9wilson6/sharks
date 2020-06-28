<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><strong>Writers earnings fee settings</strong></h3>
    </div>
    <div class="panel-body">
        <form id="biddingSettingsUpdate" action="{{ route('admin.settings.updatecommissions') }}" method="POST" class="form-horizontal" role="form" style="padding: 10px;">
            @csrf
            <div class="form-group">
                <label for="levelone">Level 1 (In percentages eg 40)</label>
                <input type="number" required max="100" name="levelone" id="levelone" value="{{ defaultsettings()['levelone'] }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="leveltwo">Level 2 (In percentages eg 40)</label>
                <input type="number" required max="100" name="leveltwo" id="leveltwo" value="{{ defaultsettings()['leveltwo'] }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="levelthree">Level 3 (In percentages eg 40)</label>
                <input type="number" required max="100" name="levelthree" id="levelthree" value="{{ defaultsettings()['levelthree'] }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="levelfour">Level 4 (In percentages eg 40)</label>
                <input type="number" required max="100" name="levelfour" id="levelfour" value="{{ defaultsettings()['levelfour'] }}" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>