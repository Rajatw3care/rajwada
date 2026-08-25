$(function() {
    $('#ceremonyForm').validate({
        // The file input in x-forms.file is visually hidden (Tailwind `hidden`
        // class) behind a custom dropzone, so the shared `ignore: ':hidden'`
        // default would skip it — override to validate it here.
        ignore: [],
        rules: {
            // `required` for Icon comes from the native `required` attribute
            // that x-forms.file already sets conditionally (only when adding
            // a new ceremony, not when editing one that already has an icon).
            icon: {
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
            icon: { imageType: 'Please upload a JPG, PNG, or WEBP image' },
            title: { required: 'Title is required', notBlank: 'Title cannot be blank spaces' },
            description: { required: 'Description is required', notBlank: 'Description cannot be blank spaces' },
            sort_order: { digits: 'Sort Order must be a whole number', min: 'Sort Order cannot be negative' }
        }
    });
});
