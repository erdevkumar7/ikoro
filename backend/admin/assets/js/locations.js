$(document).ready(function() {
    
    $('input').css('text-transform', 'capitalize');
        
    $("#add_country").click(function(e){
        var country = ucfirst($("#country-text").val());
        var action = $("#country-text").attr("store");

        var hascountry = $('#country-select option[value="'+country+'"]').val() ?? '';
        
        if(hascountry != ""){
            alert("country already added");
            $("#country-text").val("");
            return false;
        }

        if(country == ""){
            alert("Enter country first!!")
            $("#country-text").focus();
            return false;
        }

        $.ajax({
            url: action,
            type: "POST",
            cache: false,
            data: {country},
            success: function (response) {
                $('.form-select').val('');

                alert(response.success);
                $("#country-select").append(
                    $('<option></option>').val(response.country.id).html(response.country.name)
                );
                $("#country-text").val("");
            }
        });
    });

    $("#country-select").change(function(e){
        var country_id = $( "#country-select" ).val();
        var action = $( "#country-select" ).attr("get_states_action");

        $("#state-select option").remove();
        $("#state-select").append($('<option value="" selected>Select State</option>'));

        $("#city-select option").remove();
        $("#city-select").append($('<option value="" selected>Select City</option>'));

        $("#zipcode-select option").remove();
        $("#zipcode-select").append($('<option value="" selected>Open this select menu</option>'));

        $.ajax({
            url: action,
            type: "GET",
            cache: false,
            data: {country_id},
            success: function (options) {
                var selectOption = $("#state-select");
                $.each(options, function (val, option) {
                    if(option != ""){
                        selectOption.append(
                            $('<option></option>').val(option.id).html(option.name)
                        );
                    }
                });                
            }
        });
        
    });
    
    $("#add_state").click(function(e){
        var country_id = $( "#country-select" ).val();
        var state = ucfirst($("#state-text").val());
        var action = $("#state-text").attr("store");

        var hasState = $('#state-select option[value="'+state+'"]').val() ?? '';
        if(hasState != ""){
            alert("State already added");
            $("#state-text").val("");
            return false;
        }

        if(country_id == ""){
            alert("Select country from 1st column!!")
            return false;
        }

        if(state == ""){
            alert("Enter state name!!")
            $("#state-text").focus();
            return false;
        }

        $.ajax({
            url: action,
            type: "POST",
            cache: false,
            data: {country_id, state},
            success: function (response) {
                $('#state-select').val('');

                alert(response.success);
                $("#state-select").append(
                    $('<option></option>').val(response.state.id).html(response.state.name)
                );
                $("#state-text").val("");
            }
        });
    });

    $("#state-select").change(function(e){
        var state_id = $( "#state-select" ).val();
        var action = $( "#state-select" ).attr("get_city_action");

        $("#city-select option").remove();
        $("#city-select").append($('<option value="" selected>Select City</option>'));

        $("#zipcode-select option").remove();
        $("#zipcode-select").append($('<option value="" selected>Open this select menu</option>'));

        $.ajax({
            url: action,
            type: "GET",
            cache: false,
            data: {state_id},
            success: function (options) {
                var selectOption = $("#city-select");
                $.each(options, function (val, option) {
                    if(option != ""){
                        selectOption.append(
                            $('<option></option>').val(option.id).html(option.name)
                        );
                    }
                });  
            }
        });        
    });

    $("#add_city").click(function(e){
        var country_id = $( "#country-select" ).val();
        var state_id = $("#state-select").val();
        var city = ucfirst($("#city-text").val());
        
        var action = $("#city-text").attr("store");

        var hasCity = $('#city-select option[value="'+city+'"]').val() ?? '';
        if(hasCity != ""){
            alert("City already added");
            $("#city-text").val("");
            return false;
        }

        if(country_id == ""){
            alert("Select country from 1st column!!")
            return false;
        }

        if(state_id == ""){
            alert("Select state from 2nd column!!")
            return false;
        }

        if(city == ""){
            alert("Enter city name!!")
            $("#city-text").focus();
            return false;
        }

        $.ajax({
            url: action,
            type: "POST",
            cache: false,
            data: {country_id, state_id, city},
            success: function (response) {
                $('#city-select').val('');
                alert(response.success);
                $("#city-select").append(
                    $('<option></option>').val(response.city.id).html(response.city.name)
                );
                $("#city-text").val("");
            }
        });
    });

    $("#city-select").change(function(e){
        var city_id = $( "#city-select" ).val();
        var action = $( "#city-select" ).attr("get_zipcodes_action");
        
        $("#zipcode-select option").remove();
        $("#zipcode-select").append($('<option value="" selected>Open this select menu</option>'));

        $.ajax({
            url: action,
            type: "GET",
            cache: false,
            data: {city_id},
            success: function (options) {
                var selectOption = $("#zipcode-select");
                $.each(options, function (val, option) {
                    if(option != ""){
                        selectOption.append(
                            $('<option></option>').val(option.id).html(option.code)
                        );
                    }
                });                
            }
        });        
    });

    $("#add_zipcode").click(function(e){
        var country_id = $( "#country-select" ).val();
        var state_id = $("#state-select").val();
        var city_id = $("#city-select").val();
        var zipcode = $("#zipcode-text").val();

        var action = $("#zipcode-text").attr("store");

        var hasZipcode = $('#zipcode-select option[value="'+zipcode+'"]').val() ?? '';
        if(hasZipcode != ""){
            alert("Zipcode already added");
            $("#zipcode-text").val("");
            return false;
        }
        if(country_id == ""){
            alert("Select country from 1st column!!")
            return false;
        }

        if(state_id == ""){
            alert("Select state from 2nd column!!")
            return false;
        }

        if(city_id == ""){
            alert("Select city from 3rd column!!")
            return false;
        }

        if(zipcode == ""){
            alert("Enter zipcode!!")
            $("#zipcode-text").focus();
            return false;
        }

        $.ajax({
            url: action,
            type: "POST",
            cache: false,
            data: {country_id, state_id, city_id, zipcode},
            success: function (response) {
                $('#zipcode-select').val('');
                alert(response.success);
                $("#zipcode-select").append(
                    $('<option></option>').val(response.zipcode.id).html(response.zipcode.code)
                );
                $("#zipcode-text").val("");
            }
        });
    });

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    function ucfirst(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

});