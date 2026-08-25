/**
 * Exposed as window.setupRatingStatFormValidation (not a plain
 * $(function(){...})) because this form is also opened inside the modal on
 * /rating-stats (index.blade.php fetches create/edit and injects it via
 * Alpine's x-html) — script tags in that injected HTML never execute, so
 * the modal's Alpine code calls this function manually after the form is
 * in the DOM. Direct full-page loads of create/edit still self-invoke.
 */
window.setupRatingStatFormValidation = function() {
    if (!$('#ratingStatForm').length) {
        return;
    }

    $('#ratingStatForm').validate({
        rules: {
            icon: {
                required: true,
                notBlank: true
            },
            // Not using jQuery Validate's `number` rule here — existing values
            // like "4.9 / 5" and "500+" are display strings, not plain
            // numbers, so a strict numeric check would break them.
            number: {
                required: true,
                notBlank: true
            },
            label: {
                required: true,
                notBlank: true
            },
            sort_order: {
                digits: true, // whole numbers only, blocks "-"
                min: 0
            }
        },
        messages: {
            icon: { required: 'Icon is required', notBlank: 'Icon cannot be blank spaces' },
            number: { required: 'Number is required', notBlank: 'Number cannot be blank spaces' },
            label: { required: 'Label is required', notBlank: 'Label cannot be blank spaces' },
            sort_order: { digits: 'Display Order must be a whole number', min: 'Display Order cannot be negative' }
        }
    });
};

$(function() {
    window.setupRatingStatFormValidation();
});
