/**
 * Exposed as window.setupBlogPostFormValidation (not a plain
 * $(function(){...})) because this form is also opened inside the modal on
 * /blog-posts (index.blade.php fetches create/edit and injects it via
 * Alpine's x-html) — script tags in that injected HTML never execute, so
 * the modal's Alpine code calls this function manually after the form is
 * in the DOM. Direct full-page loads of create/edit still self-invoke below.
 */
window.setupBlogPostFormValidation = function() {
    if (!$('#blogPostForm').length) {
        return;
    }

    $('#blogPostForm').validate({
        // The file input in x-forms.file, the CKEditor textarea behind
        // x-forms.richtext, and the Tags widget's real value (see
        // x-forms.tags-input) are all natively hidden — the shared
        // `ignore: ':hidden'` default would skip them, so override here.
        ignore: [],
        rules: {
            // No explicit `required` here — x-forms.file already renders the
            // native `required` attribute conditionally (only when there's
            // no current image), and jQuery Validate picks that up on its
            // own. That way Image stays mandatory on create, but editing a
            // post that already has one doesn't force a re-upload.
            image: {
                imageType: true
            },
            title: {
                required: true,
                notBlank: true
            },
            venue: {
                required: true,
                notBlank: true
            },
            excerpt: {
                required: true,
                notBlank: true
            },
            body: {
                richTextRequired: true
            },
            category: {
                required: true,
                notBlank: true
            },
            tags: {
                maxTags: 5
            },
            sort_order: {
                digits: true, // whole numbers only, blocks "-"
                min: 0
            },
            share_facebook_url: {
                shareUrl: true
            },
            share_twitter_url: {
                shareUrl: true
            },
            share_whatsapp_url: {
                shareUrl: true
            },
            share_email_url: {
                email: true
            }
        },
        messages: {
            image: { required: 'Please upload an image', imageType: 'Please upload a JPG, PNG, or WEBP image' },
            title: { required: 'Title is required', notBlank: 'Title cannot be blank spaces' },
            venue: { required: 'Venue is required', notBlank: 'Venue cannot be blank spaces' },
            excerpt: { required: 'Excerpt is required', notBlank: 'Excerpt cannot be blank spaces' },
            body: { richTextRequired: 'Body is required' },
            category: { required: 'Category is required', notBlank: 'Category cannot be blank spaces' },
            tags: { maxTags: 'Please add no more than 5 tags' },
            sort_order: { digits: 'Display Order must be a whole number', min: 'Display Order cannot be negative' },
            share_facebook_url: { shareUrl: 'Enter a valid URL (starting with http://, https://, or mailto:)' },
            share_twitter_url: { shareUrl: 'Enter a valid URL (starting with http://, https://, or mailto:)' },
            share_whatsapp_url: { shareUrl: 'Enter a valid URL (starting with http://, https://, or mailto:)' },
            share_email_url: { email: 'Enter a valid email address' }
        }
    });
};

$(function() {
    window.setupBlogPostFormValidation();
});
