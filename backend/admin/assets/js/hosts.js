$(document).ready(function() {

    $(".delete_host").click(function(){
        var link = $(this).attr("link");
        var id = $(this).attr("host_id");

        $.ajax({
            url: link,
            type: "GET",
            cache: false,
            data: {id:id},
            success: function (response) {
                location.reload();
            },
            error: function (response) {
                $("#overlay").fadeOut();
            },
        });
    });
    
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(document).ajaxStart(function () {
        $('#loading-spinner').show(); // Show loading spinner
    });

    // Hide loading spinner when the AJAX request finishes
    $(document).ajaxStop(function () {
        $('#loading-spinner').hide(); // Hide loading spinner
    });

    $(".recommended").on("input",function(){
        var link = $(this).attr("link");
        var seq = $(this).val();

        $.ajax({
            url: link,
            type: "POST",
            cache: false,
            data: {seq},
            success: function (response) {
                location.reload();
            },
            error: function (response) {
                $("#overlay").fadeOut();
            },
        });
    });

});

function updateStatus(element, url) {
    var selectedStatus = element.value;
    var updateUrl = url + '?status=' + selectedStatus;
    $.ajax({
        url: updateUrl,
        type: "GET",
        cache: false,
        success: function (response) {
            location.reload();
        },
        error: function (response) {
            alert('Error updating status. Please try again.');
        },
    });
}
