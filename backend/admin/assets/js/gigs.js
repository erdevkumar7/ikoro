$(document).ready(function () {
  let has_gig_id = $("#has_gig_id").val() ?? "";
  if (has_gig_id != "") {
    $("#gigFile" + has_gig_id).modal("show");
  }

  $("#equipment_price_id").change(function () {
    var price = $("option:selected", this).attr("price");
    var mins = $("option:selected", this).attr("minutes");
    var equipment_name = $("option:selected", this).attr("equipment_name");
    var equipment_id = $("option:selected", this).attr("equipment_id");

    $("#pricing").val(price + " per " + mins + " minutes");
    $("#equipment_name").val(equipment_name);
    $("#price").val(price);
    $("#minutes").val(mins);
    $("#eq_id").val(equipment_id);
  });

  // $(".add_more").click(function(){
  //     $("#html_to").html($("#html_from").html());
  // });

  $(document).ready(function () {
    /*
        function createRow() {
            return `<div class="form-row row">
                        <div class="form-group col-md-5">
                            <label>Label</label>
                            <input type="text" class="form-control" name="features[label][]" required />
                            <x-input-error :messages="$errors->get('feat')" class="mt-2" />
                        </div>
                        <div class="form-group col-md-5">
                            <label>Value</label>
                            <input type="text" class="form-control" name="features[value][]" required />
                            <x-input-error :messages="$errors->get('val')" class="mt-2" />
                        </div>
                        <div class="form-group col-md-2 mt-2">
                            <br>
                            <button type="button" class="remove btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>`;
        }
        */

    function createRow() {
      return `<div class="form-row row">
                <div class="form-group col-md-5">
                    <label>Label</label>
                    <input type="text" class="form-control" name="features[label][]" required />
                    <x-input-error :messages="$errors->get('feat')" class="mt-2" />
                </div>
                <div class="form-group col-md-5">
                    <label>Value (Image)</label>
                    <input type="file" class="form-control" name="features[value][]" required />
                    <input type="hidden" name="features[old_value][]" value="" />  <!-- Hidden field for old value -->
                    <x-input-error :messages="$errors->get('val')" class="mt-2" />
                </div>
                <div class="form-group col-md-2 mt-2">
                    <br>
                    <button type="button" class="remove btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>`;
    }

    $(".add_more").click(function () {
      $("#html_to").append(createRow());
    });

    $("#html_to").on("click", ".remove", function () {
      $(this).closest(".form-row").remove();
    });

    // for (let i = 0; i < 3; i++) {
    //     $('#html_to').append(createRow());
    // }
  });

  /*
  $(document).on("click", ".remove_gig_media", function () {
    confirm("are you sure want to delete!");
    let url = $(this).attr("route");
    $.ajax({
      method: "GET",
      url: url,
      success: function (res) {
        if (res.status === "success") {
          location.reload();
        }
      },
    });
  });
*/
  $(document).on("click", ".remove_gig_media_offer", function () {
    if (!confirm("Are you sure you want to delete?")) {
      return; // Stop if user cancels
    }

    let url = $(this).attr("route");

    $.ajax({
      method: "GET",
      url: url,
      success: function (res) {
        if (res.status === "success") {
          location.reload();
        } else {
          alert(res.message || "Failed to delete media!");
        }
      },
      error: function () {
        alert("Something went wrong. Please try again!");
      },
    });
  });
});
