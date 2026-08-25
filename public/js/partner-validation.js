$(function() {
    $('#partnerForm').validate({
        // The file input in x-forms.file is visually hidden (Tailwind `hidden`
        // class) behind a custom dropzone, so the shared `ignore: ':hidden'`
        // default would skip it — override to validate it here.
        ignore: [],
        rules: {
            // `required` for Logo comes from the native `required` attribute
            // that x-forms.file already sets conditionally (only when adding
            // a new partner, not when editing one that already has a logo).
            logo: {
                imageType: true
            },
            name: {
                required: true,
                notBlank: true
            },
            sort_order: {
                digits: true, // whole numbers only, blocks "-"
                min: 0
            }
        },
        messages: {
            logo: { imageType: 'Please upload a JPG, PNG, or WEBP image' },
            name: { required: 'Partner Name is required', notBlank: 'Partner Name cannot be blank spaces' },
            sort_order: { digits: 'Sort Order must be a whole number', min: 'Sort Order cannot be negative' }
        }
    });
});
