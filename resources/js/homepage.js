require('./orders');

require('./jquery-ui');

window.moment = require('moment');

require('./bootstrap-datetimepicker');

$(function() {
    $('#homedate').datetimepicker({
        format: 'YYYY-MM-DD hh:mm:ss'
    });
});


$(function() {
    $('#provision').datetimepicker({
        format: 'YYYY-MM-DD hh:mm:ss'
    });
});