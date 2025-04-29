$(document).ready(function () {
    $(document).ready(function () {
        function createRow() {
            return `<div class="form-row row">
                        <div class="form-group col-md-2">
                            <label>Tool Name</label>
                            <input type="text" class="form-control" name="features[label][]" required />
                            <x-input-error :messages="$errors->get('feat')" class="mt-2" />
                        </div>


                        <div class="form-group col-md-2">
                            <label>30 Mins</label>
                            <input type="text" class="form-control" name="features[value][]" required />
                            <x-input-error :messages="$errors->get('val')" class="mt-2" />
                        </div>
                        <div class="form-group col-md-2">
                            <label>60 Mins</label>
                            <input type="text" class="form-control" name="features[value][]" required />
                            <x-input-error :messages="$errors->get('val')" class="mt-2" />
                        </div>
                        <div class="form-group col-md-2">
                            <label>90 Mins</label>
                            <input type="text" class="form-control" name="features[value][]" required />
                            <x-input-error :messages="$errors->get('val')" class="mt-2" />
                        </div>
                        <div class="form-group col-md-2">
                            <label>120 Mins</label>
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
        $(".add_more_equip_price").click(function () {
            $("#html_to_equipment").append(createRow());
        });

        $("#html_to_equipment").on("click", ".remove", function () {
            $(this).closest(".form-row").remove();
        });
    });
});
