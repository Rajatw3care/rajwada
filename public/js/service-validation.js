/**
 * Exposed as window.setupServiceFormValidation instead of a plain
 * $(function(){...}) because this form is also opened inside the modal on
 * /manage-services (services/index.blade.php fetches the create/edit page
 * and injects it via Alpine's x-html) — script tags in that injected HTML
 * never execute, so the modal's Alpine code calls this function manually
 * after the form is in the DOM. Direct full-page loads of create/edit still
 * self-invoke below as usual.
 */
window.setupServiceFormValidation = function() {
    if (!$('#serviceForm').length) {
        return;
    }

    $('#serviceForm').validate({
        // The file inputs in x-forms.file are visually hidden (Tailwind
        // `hidden` class) behind a custom dropzone, so the shared
        // `ignore: ':hidden'` default would skip them — override here.
        ignore: [],
        rules: {
            // `required: true` here (rather than relying on x-forms.file's
            // conditional native attribute) makes Icon mandatory on every
            // save — create AND edit — even when one is already uploaded.
            icon: {
                required: true,
                imageType: true
            },
            overview_image: {
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
            overview_description: {
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
            overview_image: { imageType: 'Please upload a JPG, PNG, or WEBP image' },
            title: { required: 'Service Title is required', notBlank: 'Service Title cannot be blank spaces' },
            description: { required: 'Description is required', notBlank: 'Description cannot be blank spaces' },
            overview_description: { required: 'Overview Description is required', notBlank: 'Overview Description cannot be blank spaces' },
            sort_order: { digits: 'Display Order must be a whole number', min: 'Display Order cannot be negative' }
        }
    });
};

$(function() {
    window.setupServiceFormValidation();
});
