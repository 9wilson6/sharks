try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap-sass');
} catch (e) {}

require('./jquery-ui');

window.moment = require('moment');

require('./bootstrap-datetimepicker');

$(function() {
    $('#postdeadline').datetimepicker({
        format: 'YYYY-MM-DD hh:mm:ss'
    });
});

$(function() {
    $('#provision').datetimepicker({
        format: 'YYYY-MM-DD hh:mm:ss'
    });
});