/**
 * Exposed as window.setupVideoFormValidation (not a plain
 * $(function(){...})) because this form is also opened inside the modal on
 * /videos (index.blade.php fetches create/edit and injects it via Alpine's
 * x-html) — script tags in that injected HTML never execute, so the
 * modal's Alpine code calls this function manually after the form is in
 * the DOM. Direct full-page loads of create/edit still self-invoke below.
 */
window.setupVideoFormValidation = function() {
    if (!$('#videoForm').length) {
        return;
    }

    $('#videoForm').validate({
        // The file input in x-forms.file is visually hidden (Tailwind
        // `hidden` class) behind a custom dropzone, and the Tag field's
        // real value lives in a native `type="hidden"` input (see
        // x-forms.tags-input) — the shared `ignore: ':hidden'` default
        // would skip both, so override here.
        ignore: [],
        rules: {
            // `required: true` here (rather than relying on x-forms.file's
            // conditional native attribute) makes Thumbnail mandatory on
            // every save — create AND edit — even when one already exists.
            thumbnail: {
                required: true,
                imageType: true
            },
            title: {
                required: true,
                notBlank: true
            },
            video_url: {
                required: true,
                notBlank: true
            },
            tag: {
                maxTags: 5
            },
            duration: {
                required: true,
                notBlank: true
            },
            sort_order: {
                digits: true, // whole numbers only, blocks "-"
                min: 0
            }
        },
        messages: {
            thumbnail: { required: 'Please upload a thumbnail image', imageType: 'Please upload a JPG, PNG, or WEBP image' },
            title: { required: 'Title is required', notBlank: 'Title cannot be blank spaces' },
            video_url: { required: 'Video URL is required', notBlank: 'Video URL cannot be blank spaces' },
            tag: { maxTags: 'Please add no more than 5 tags' },
            duration: { required: 'Duration is required', notBlank: 'Duration cannot be blank spaces' },
            sort_order: { digits: 'Display Order must be a whole number', min: 'Display Order cannot be negative' }
        }
    });
};

$(function() {
    window.setupVideoFormValidation();
});
