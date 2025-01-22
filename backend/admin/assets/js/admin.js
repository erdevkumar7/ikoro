$(document).ready(function() {
    const base_url = window.location.origin + '/ikoro' ;

    $.ajax({
        url: base_url + '/admin/new-bookings-cnt',
        type: 'GET',
        success: function(data) {
            $('#cnt-new-booking').html("(" + data.new_bookings_cnt + ")");
            $('#cnt-new-booking').css("color", "red");
        }
    });

});