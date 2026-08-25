$(function() {
    $('#heroForm').validate({
        // maxlength is enforced natively via the `maxlength` attribute on each
        // input (set per-record in hero/edit.blade.php), not duplicated here.
        // The file input in x-forms.file is visually hidden (Tailwind `hidden`
        // class) behind a custom dropzone, so the shared `ignore: ':hidden'`
        // default would skip it — override to validate it here.
        ignore: [],
        rules: {
            main_image: {
                imageType: true
            },
            eyebrow: {
                required: true,
                notBlank: true
            },
            title: {
                required: true,
                notBlank: true
            },
            subtitle: {
                required: true,
                notBlank: true
            },
            cta_1_label: {
                required: true,
                notBlank: true
            },
            cta_2_label: {
                required: true,
                notBlank: true
            }
        },
        messages: {
            main_image: { imageType: 'Please upload a JPG, PNG, or WEBP image' },
            eyebrow: { required: 'Eyebrow is required', notBlank: 'Eyebrow cannot be blank spaces' },
            title: { required: 'Title is required', notBlank: 'Title cannot be blank spaces' },
            subtitle: { required: 'Subtitle is required', notBlank: 'Subtitle cannot be blank spaces' },
            cta_1_label: { required: 'Button 1 Label is required', notBlank: 'Button 1 Label cannot be blank spaces' },
            cta_2_label: { required: 'Button 2 Label is required', notBlank: 'Button 2 Label cannot be blank spaces' }
        }
    });
});
