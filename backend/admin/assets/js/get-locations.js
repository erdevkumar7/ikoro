$(document).ready(function () {
  // const base_url = window.location.origin ;
  const base_url_old = window.location.origin;
  const base_url = base_url_old + "/ikoro";
  // console.log('base_url', base_url)
  var country_trigger_cnt = 1;
  var state_trigger_cnt = 1;
  var city_trigger_cnt = 1;
  var zip_trigger_cnt = 1;
  $(".select2").select2({
    theme: "classic",
  });

  if (typeof host !== "undefined") {
    const fields = [
      { id: "country_id", value: host.country_id, delay: 0 },
      { id: "state_id", value: host.state_id, delay: 1000 },
      { id: "city_id", value: host.city_id, delay: 2000 },
      { id: "zip_id", value: host.zip_id, delay: 3000 },
    ];

    fields.forEach((field) => {
      if (field.value) {
        setTimeout(function () {
          $("#" + field.id + ", ." + field.id)
            .val(field.value)
            .trigger("change");
        }, field.delay);
      }
    });
  }

  /*
    $('#country_id, .country_id').change(function() {
        var countryId = $(this).val();

        $('#state_id, .state_id').empty().append('<option value="">Select State</option>');
        $('#city_id, .city_id').empty().append('<option value="">Select City</option>');
        $('#zip_id, .zip_id').empty().append('<option value="">Select Zip</option>');

        if(country_trigger_cnt++ > 1){
            return;
        }
        if (countryId) {
            $.ajax({
                url: base_url + '/get-states/' + countryId,
                type: 'GET',
                success: function(data) {
                    $.each(data, function(key, value) {
                        $('#state_id, .state_id').append('<option value="' + value.id +
                            '">' + value.name + '</option>');
                    });
                }
            });
        }
    });

    $('#state_id, .state_id').change(function() {
        var stateId = $(this).val();
        $('#city_id, .city_id').empty().append('<option value="">Select City</option>');
        $('#zip_id, .zip_id').empty().append('<option value="">Select Zip</option>');
        
        if(state_trigger_cnt++ > 1){
            return;
        }

        if (stateId) {
            $.ajax({
                url: base_url + '/get-cities/' + stateId,
                type: 'GET',
                success: function(data) {
                    $.each(data, function(key, value) {
                        $('#city_id, .city_id').append('<option value="' + value.id +
                            '">' + value.name + '</option>');
                    });
                }
            });
        }
    });

    $('#city_id, .city_id').change(function() {
        var cityId = $(this).val();
        $('#zip_id, .zip_id').empty().append('<option value="">Select Zip</option>');

        if(city_trigger_cnt++ > 1){
            return;
        }
        if (cityId) {
            $.ajax({
                url: base_url + '/get-zips/' + cityId,
                type: 'GET',
                success: function(data) {
                    $.each(data, function(key, value) {
                        $('#zip_id, .zip_id').append('<option value="' + value.id +
                            '">' + value.code + '</option>');
                    });
                }
            });
        }
        updateMap();
    });
    function updateMap() {
        var cityId = document.getElementById('city_id').value;

        if (!cityId) return;

        var cityName = $('#city_id option:selected').text();

        console.log(cityName)
        
        var cityFormatted = cityName.replace(/\s+/g, '+');
    
        console.log(cityFormatted)

        var baseUrl = "https://www.google.com/maps/embed?pb=";
    
        var newSrc = baseUrl + encodeURIComponent("!1m18!1m12!1m3!1d3153.1558363657617!2d-122.4217787846816!3d37.774929779759476!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8085808bb6c4cc3d%3A0x37625db62e4ff4f4!2s"+cityFormatted+"!5e0!3m2!1sen!2sin!4v1611287579370!5m2!1sen!2sin");
    
        document.getElementById('map').src = newSrc;
    }
*/

  $("#country_id, .country_id").change(function () {
    var countryId = $(this).val();

    $("#state_id, .state_id")
      .empty()
      .append('<option value="">Select State</option>');
    $("#city_id, .city_id")
      .empty()
      .append('<option value="">Select City</option>');
    $("#zip_id, .zip_id")
      .empty()
      .append('<option value="">Select Zip</option>');

    if (countryId) {
      $.ajax({
        url: base_url + "/get-states/" + countryId,
        type: "GET",
        success: function (data) {
          $.each(data, function (key, value) {
            $("#state_id, .state_id").append(
              '<option value="' + value.id + '">' + value.name + "</option>"
            );
          });
        },
      });
    }
  });

  $("#state_id, .state_id").change(function () {
    var stateId = $(this).val();
    $("#city_id, .city_id")
      .empty()
      .append('<option value="">Select City</option>');
    $("#zip_id, .zip_id")
      .empty()
      .append('<option value="">Select Zip</option>');

    if (stateId) {
      $.ajax({
        url: base_url + "/get-cities/" + stateId,
        type: "GET",
        success: function (data) {
          $.each(data, function (key, value) {
            $("#city_id, .city_id").append(
              '<option value="' + value.id + '">' + value.name + "</option>"
            );
          });
        },
      });
    }
  });

  $("#city_id, .city_id").change(function () {
    var cityId = $(this).val();
    $("#zip_id, .zip_id")
      .empty()
      .append('<option value="">Select Zip</option>');

    if (cityId) {
      $.ajax({
        url: base_url + "/get-zips/" + cityId,
        type: "GET",
        success: function (data) {
          $.each(data, function (key, value) {
            $("#zip_id, .zip_id").append(
              '<option value="' + value.id + '">' + value.code + "</option>"
            );
          });
        },
      });
    }

    updateMap();
  });
  function updateMap() {
    var cityId = document.getElementById("city_id").value;

    if (!cityId) return;

    var cityName = $("#city_id option:selected").text().trim();

    console.log("Selected city:", cityName);

    var cityFormatted = encodeURIComponent(cityName); // Proper URL encoding

    var newSrc =
      "https://www.google.com/maps/embed/v1/place?key=YOUR_GOOGLE_MAPS_API_KEY&q=" +
      cityFormatted;

    document.getElementById("map").src = newSrc;
  }
});
