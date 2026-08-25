$(function() {
    $('#tickerItemForm').validate({
        rules: {
            text: {
                required: true,
                notBlank: true,
                maxlength: 30
            },
            sort_order: {
                digits: true, // whole numbers only, blocks "-"
                min: 0
            }
        },
        messages: {
            text: {
                required: 'Text is required',
                notBlank: 'Text cannot be blank spaces',
                maxlength: 'Text must not exceed 30 characters'
            },
            sort_order: {
                digits: 'Sort Order must be a whole number',
                min: 'Sort Order cannot be negative'
            }
        }
    });
});
