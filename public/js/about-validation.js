$(function() {
    $('#aboutForm').validate({
        // Several fields here are natively hidden — the file inputs behind
        // x-forms.file's custom dropzone, and the CKEditor textarea behind
        // x-forms.richtext — so the shared `ignore: ':hidden'` default would
        // skip them. Override to validate everything on this form.
        ignore: [],
        rules: {
            // `required` for these image fields comes from the native
            // `required` attribute that x-forms.file already sets
            // conditionally (only when there's no existing image) — not
            // duplicated here, so re-saving without re-uploading still works.
            page_banner_image: {
                imageType: true,
                maxFileSize: 4096 // KB, mirrors server's image|max:4096
            },
            image_1: {
                imageType: true,
                maxFileSize: 4096
            },
            image_2: {
                imageType: true,
                maxFileSize: 4096
            },
            image_3: {
                imageType: true,
                maxFileSize: 4096
            },
            badge_image: {
                imageType: true,
                maxFileSize: 2048 // KB, mirrors server's image|max:2048
            },
            heading: {
                required: true,
                notBlank: true
            },
            body: {
                richTextRequired: true
            },
            cta_label: {
                required: true,
                notBlank: true,
                maxlength: 15
            }
        },
        messages: {
            page_banner_image: { imageType: 'Please upload a JPG, PNG, or WEBP image', maxFileSize: 'Image must not exceed 4MB' },
            image_1: { imageType: 'Please upload a JPG, PNG, or WEBP image', maxFileSize: 'Image must not exceed 4MB' },
            image_2: { imageType: 'Please upload a JPG, PNG, or WEBP image', maxFileSize: 'Image must not exceed 4MB' },
            image_3: { imageType: 'Please upload a JPG, PNG, or WEBP image', maxFileSize: 'Image must not exceed 4MB' },
            badge_image: { imageType: 'Please upload a JPG, PNG, or WEBP image', maxFileSize: 'Image must not exceed 2MB' },
            heading: { required: 'Heading is required', notBlank: 'Heading cannot be blank spaces' },
            body: { richTextRequired: 'Body is required' },
            cta_label: { required: 'Button Label is required', notBlank: 'Button Label cannot be blank spaces', maxlength: 'Button Label must not exceed 15 characters' }
        }
    });
});
