$(function() {
    $('#teamMemberForm').validate({
        // The file input in x-forms.file is visually hidden (Tailwind `hidden`
        // class) behind a custom dropzone, so the shared `ignore: ':hidden'`
        // default would skip it — override to validate it here.
        ignore: [],
        rules: {
            // `required` for Photo comes from the native `required` attribute
            // that x-forms.file already sets conditionally (only when adding
            // a new member, not when editing one that already has a photo).
            photo: {
                imageType: true
            },
            name: {
                required: true,
                notBlank: true
            },
            role: {
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
            photo: { imageType: 'Please upload a JPG, PNG, or WEBP image' },
            name: { required: 'Name is required', notBlank: 'Name cannot be blank spaces' },
            role: { required: 'Role is required', notBlank: 'Role cannot be blank spaces' },
            description: { required: 'Description is required', notBlank: 'Description cannot be blank spaces' },
            sort_order: { digits: 'Sort Order must be a whole number', min: 'Sort Order cannot be negative' }
        }
    });
});
