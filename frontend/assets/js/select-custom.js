 $(document).ready(function() {
      // 1.Multiple Select
        // Initialize Select2
        $('#options').select2({
            placeholder: 'Select options',
            allowClear: true
        });

        // Define options
        var options = [
            { id: 'option1', text: 'Option 1' },
            { id: 'option2', text: 'Option 2' },
            { id: 'option3', text: 'Option 3' },
            { id: 'option4', text: 'Option 4' }
        ];

        // Populate Select2 with options
        $('#options').select2({
            data: options,
            placeholder: 'Select options',
            allowClear: true
        });

        // Example of pre-selected options
        var preselected = [];
        $('#options').val(preselected).trigger('change');




       // 2.Multiple Select with Pre-Filled Input
        $('#options1').select2({
            placeholder: 'Select options',
            allowClear: true
        });

        // Define options
        var options = [
            { id: 'option1', text: 'Option 1' },
            { id: 'option2', text: 'Option 2' },
            { id: 'option3', text: 'Option 3' },
            { id: 'option4', text: 'Option 4' }
        ];

        // Populate Select2 with options
        $('#options1').select2({
            data: options,
            placeholder: 'Select options',
            allowClear: true
        });

        // Example of pre-selected options
        var preselected = ['option1'];
        $('#options1').val(preselected).trigger('change');



        // 3.Multiple Select (Disabled)
        $('#options2').select2({
            placeholder: 'Select options',
            allowClear: true
        });

        // Define options
        var options = [
            { id: 'option1', text: 'Option 1' },
            { id: 'option2', text: 'Option 2' },
            { id: 'option3', text: 'Option 3' },
            { id: 'option4', text: 'Option 4' }
        ];

        // Populate Select2 with options
        $('#options2').select2({
            data: options,
            placeholder: 'Select options',
            allowClear: true
        });

        // Example of pre-selected options
        var preselected = ['option1'];
        $('#options2').val(preselected).trigger('change');


        //single select
        var options = [
                { id: 'option1', text: 'Option 1' },
                { id: 'option2', text: 'Option 2' },
                { id: 'option3', text: 'Option 3' },
                { id: 'option4', text: 'Option 4' }
            ];

            // Initialize Select2 for single select with no search box
            $('#single-select').select2({
                data: options,
                placeholder: 'Select an option',
                allowClear: true,
                minimumResultsForSearch: Infinity  // This hides the search box
            });

            // Example of pre-selected option
            var preselected = '';
            $('#single-select').val(preselected).trigger('change');


// Single select with search
        $('#single-select-search').select2({
                placeholder: 'Select an option',
                allowClear: true
            });

            // Define options
            var options = [
                { id: 'option1', text: 'Option 1' },
                { id: 'option2', text: 'Option 2' },
                { id: 'option3', text: 'Option 3' },
                { id: 'option4', text: 'Option 4' }
            ];

            // Populate Select2 with options
            $('#single-select-search').select2({
                data: options,
                placeholder: 'Select an option',
                allowClear: true
            });

            // Example of pre-selected option
            var preselected = '';
            $('#single-select-search').val(preselected).trigger('change');

            //Single select disbaled
            $('#single-select-disabled').select2({
                    placeholder: 'Select an option',
                    allowClear: true
                });
    
                // Define options
                var options = [
                    { id: 'option1', text: 'Option 1' },
                    { id: 'option2', text: 'Option 2' },
                    { id: 'option3', text: 'Option 3' },
                    { id: 'option4', text: 'Option 4' }
                ];
    
                // Populate Select2 with options
                $('#single-select-disabled').select2({
                    data: options,
                    placeholder: 'Select an option',
                    allowClear: true
                });
    
                // Example of pre-selected option
                var preselected = '';
                $('#single-select-disabled').val(preselected).trigger('change');

            
    });

