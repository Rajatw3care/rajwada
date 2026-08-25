$(function() {
    $('#heroStripImageForm').validate({
        // The file input in x-forms.file is visually hidden (Tailwind `hidden`
        // class) behind a custom dropzone, so the shared `ignore: ':hidden'`
        // default would skip it — override to validate it here.
        ignore: [],
        rules: {
            image: {
                required: true,
                imageType: true,
                maxFileSize: 4096 // KB, mirrors server's image|max:4096
            },
            sort_order: {
                digits: true, // whole numbers only, blocks "-" and decimals
                min: 0
            }
        },
        messages: {
            image: {
                required: 'Please select an image to upload',
                imageType: 'Please upload a JPG, PNG, or WEBP image',
                maxFileSize: 'Image must not exceed 4MB'
            },
            sort_order: {
                digits: 'Sort Order must be a whole number',
                min: 'Sort Order cannot be negative'
            }
        }
    });
});
