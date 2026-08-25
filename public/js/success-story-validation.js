/**
 * Exposed as window.setupSuccessStoryFormValidation (not a plain
 * $(function(){...})) because this form is also opened inside the modal on
 * /success-stories (index.blade.php fetches create/edit and injects it via
 * Alpine's x-html) — script tags in that injected HTML never execute, so
 * the modal's Alpine code calls this function manually after the form is
 * in the DOM. Direct full-page loads of create/edit still self-invoke.
 */
window.setupSuccessStoryFormValidation = function() {
    if (!$('#successStoryForm').length) {
        return;
    }

    $('#successStoryForm').validate({
        // The file input in x-forms.file is visually hidden (Tailwind
        // `hidden` class) behind a custom dropzone, so the shared
        // `ignore: ':hidden'` default would skip it — override here.
        ignore: [],
        rules: {
            // `required: true` here (rather than relying on x-forms.file's
            // conditional native attribute) makes Image mandatory on every
            // save — create AND edit — even when one is already uploaded.
            image: {
                required: true,
                imageType: true
            },
            title: {
                required: true,
                notBlank: true
            },
            location: {
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
            image: { required: 'Please upload an image', imageType: 'Please upload a JPG, PNG, or WEBP image' },
            title: { required: 'Title is required', notBlank: 'Title cannot be blank spaces' },
            location: { required: 'Location is required', notBlank: 'Location cannot be blank spaces' },
            description: { required: 'Description is required', notBlank: 'Description cannot be blank spaces' },
            sort_order: { digits: 'Display Order must be a whole number', min: 'Display Order cannot be negative' }
        }
    });
};

$(function() {
    window.setupSuccessStoryFormValidation();
});
