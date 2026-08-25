$(function() {
    $('#whyChooseItemForm').validate({
        // The file input in x-forms.file is visually hidden (Tailwind `hidden`
        // class) behind a custom dropzone, so the shared `ignore: ':hidden'`
        // default would skip it — override to validate it here.
        ignore: [],
        rules: {
            // `required: true` here (rather than relying on x-forms.file's
            // conditional native attribute) makes Icon mandatory on every
            // save — create AND edit — even when one is already uploaded.
            icon: {
                required: true,
                imageType: true
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
            icon: { required: 'Please upload an icon image', imageType: 'Please upload a JPG, PNG, or WEBP image' },
            title: { required: 'Title is required', notBlank: 'Title cannot be blank spaces' },
            description: { required: 'Description is required', notBlank: 'Description cannot be blank spaces' },
            sort_order: { digits: 'Sort Order must be a whole number', min: 'Sort Order cannot be negative' }
        }
    });
});
