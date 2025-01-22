$(document).ready(function() {

    $("form").submit(function(e){
        e.preventDefault(); 
        var data = $("#taskForm").serialize();
        var action = $("#taskForm").attr("action");
        popupFlag = 0; 
        
        $.ajax({
            url: action,
            type: "POST",
            cache: false,
            data: data,
            success: function (response) {
                location.reload();
            },
            error: function (response) {
                $("#overlay").fadeOut();
            },
        });
    });

    $("#add_task_btn").click(function(){

        $('.task-modal-title').html("Add New Task");

        $('#id').val("");
        $('#title').val("");
        $('#fixed_price_amount').val("");
        $('#hourly_price_amount').val("");
        $('#currency').val("");
        $('#description').val("");

        $('#taskModal').modal('show');
    });

    $(".editbtn").click(function(){
        $('.task-modal-title').html("Edit Task");
        var taskDetails = JSON.parse($(this).attr("task"));
        console.log(taskDetails);

        $('#id').val(taskDetails.id);
        $('#title').val(taskDetails.title);
        $('#icon').val(taskDetails.icon);
        $('#fixed_price_amount').val(taskDetails.fixed_price_amount);
        $('#hourly_price_amount').val(taskDetails.hourly_price_amount);
        $('#currency').val(taskDetails.currency);
        $('#description').val(taskDetails.description);

        $('#taskModal').modal('show');
    });

    $('#simpleModal').on('hidden.bs.modal', function () {
        location.reload();
    });

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(".delete_task").click(function(){
        var link = $(this).attr("link");
        var id = $(this).attr("task_id");

        $.ajax({
            url: link,
            type: "POST",
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
});