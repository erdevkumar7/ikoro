$(document).ready(function () {
     $("#home-booking-form").on("submit", function () {
        // $("#home-booking-btn").prop("disabled", true);
        // $("#pay-btn").prop("disabled", true);
    });

    $(".book-a-task").click(function () {
        var loggedIn = $("#loggedIn").val();
        if (loggedIn == "") {
            $('#loginModal').modal('show');
        }
    });

    $(".book-a-task").click(function () {
        var loggedIn = $("#loggedIn").val();
        if (loggedIn == "") {
            $('#loginModal').modal('show');
        }
    });

    if ($("#filter_flag").val() != "") {
        $('html, body').animate({
            scrollTop: $('#search-filter').offset().top
        }, 1000);
    }


    $("#equipment_id").change(function () {
        let url = $(this).attr('data-url');
        var equipment_id = $('option:selected', this).val() ?? "";
        $.ajax({
            method: 'GET',
            url: url,
            data: { equipment_id: equipment_id },
            success: function (res) {
                let html = '';
                $.each(res, function (key, row) {
                    html += '<option value="' + row.id + '" data-price="' + row.price + '">' + row.duration_minutes + ' minutes</option>';
                });
                $("#hours").html(html);
            }
        });
    });

    $("#hours").change(function () {
        var price = $('option:selected', this).attr("data-price");
        $('#total_cost').val(price);
    });

});


$(document).ready(function () {
    $(document).on('click', '#task', function () {
        let taskId = $(this).data('id');
        let url = $(this).data('url');
        try {
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    task_id : taskId
                }, // Send form data
                success: function(response) {
                    $('#gigs-container').html(response.html);
                }
            });
        } catch (xhr) {
            console.log(xhr.responseText);
        }
    });
});


jQuery(document).ready(function ($) {
    let owl = $('#owl-carousel-top')
    owl.owlCarousel({
        // loop: true,
        nav: true,
        margin: 10,
        ltr: true,
        autoplay: true,
        autoplayTimeout: 1000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            960: {
                items: 5
            },
            1200: {
                items: 6
            }
        }
    });

    $('#next').click(function () {
        owl.trigger('next.owl.carousel');
    })
    $('#prev').click(function () {
        owl.trigger('prev.owl.carousel');
    });

    owl.on('mousewheel', '.owl-stage', function (e) {
        if (e.deltaY > 0) {
            owl.trigger('next.owl');
        } else {
            owl.trigger('prev.owl');
        }
        e.preventDefault();
    });

    //optional because already defined autoplayHoverPause: true, 
    $('#owl-carousel-top').hover(
        function () {
            owl.trigger('stop.owl.autoplay');
        },
        function () {
            owl.trigger('play.owl.autoplay', [1000]);
        }
    );
});

jQuery(document).ready(function ($) {
    "use strict";
    $('#customers-testimonials').owlCarousel({
        loop: true,
        center: true,
        items: 3,
        margin: 0,
        autoplay: true,
        dots: true,
        autoplayTimeout: 8500,
        smartSpeed: 450,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            1170: {
                items: 3
            }
        }
    });
    "use strict";

    $('#feedback-testimonials').owlCarousel({
        loop: true,
        center: true,
        items: 3,
        margin: 0,
        autoplay: true,
        dots: true,
        autoplayTimeout: 8500,
        smartSpeed: 450,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            1170: {
                items: 2
            }
        }
    });
});



$(document).ready(function () {
    $('#owl-carousel-top .owl-item').removeAttr('style');
});


$(document).ready(function(){
    $('#citySearchByInput').on('keyup', function () {
        let query = $(this).val();
        let url = $(this).attr('data-url');
        if (query.length > 1) {
            $.ajax({
                url: url,
                type: "GET",
                data: { query: query },
                success: function (data) {
                    let dropdown = $('#cityDropdown');
                    dropdown.empty().show();

                    if (data.length > 0) {
                        $.each(data, function (index, city) {
                            dropdown.append(`<div class="dropdown-item city-item" data-id="${city.id}">${city.name}</div>`);
                        });
                    } else {
                        dropdown.append('<div class="dropdown-item">No city found</div>');
                    }
                }
            });
        } else {
            $('#cityDropdown').hide();
        }
    });

    // Handle city selection
    $(document).on('click', '.city-item', function () {
        let cityName = $(this).text();
        let cityId = $(this).data('id');
    
        // Set the city name in the input field
        $('#citySearchByInput').val(cityName);    
        // Create a hidden input field to store the city ID
        if ($('#selectedCityId').length === 0) {
            $('#citySearchByInput').after(`<input type="hidden" name="city_id" id="selectedCityId" value="${cityId}">`);
        } else {
            $('#selectedCityId').val(cityId);
        }
    
        $('#cityDropdown').hide();
    });
    

    // Hide dropdown when clicking outside
    $(document).click(function (event) {
        if (!$(event.target).closest('#citySearchByInput, #cityDropdown').length) {
            $('#cityDropdown').hide();
        }
    });
});


