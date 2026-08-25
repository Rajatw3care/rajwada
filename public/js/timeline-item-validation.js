$(function() {
    $('#timelineItemForm').validate({
        rules: {
            year: {
                required: true,
                notBlank: true
            },
            title: {
                required: true,
                notBlank: true
            },
            description: {
                required: true,
                notBlank: true
            },
            sort_order: {
                digits: true, // whole numbers only, blocks "-"
                min: 0
            }
        },
        messages: {
            year: { required: 'Year is required', notBlank: 'Year cannot be blank spaces' },
            title: { required: 'Title is required', notBlank: 'Title cannot be blank spaces' },
            description: { required: 'Description is required', notBlank: 'Description cannot be blank spaces' },
            sort_order: { digits: 'Sort Order must be a whole number', min: 'Sort Order cannot be negative' }
        }
    });
});
