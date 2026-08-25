/**
 * Common jQuery Validate defaults used across all admin forms.
 * Include this file (after jquery.validate.min.js) and then call
 * $('#yourForm').validate({ rules: { ... }, messages: { ... } })
 * on each page — the styling/error placement below applies automatically.
 */
$.validator.setDefaults({
    errorElement: 'p',
    // Must be a dot-free class name — jQuery Validate joins errorClass words
    // with "." to build its internal lookup selector, so a Tailwind class
    // like "mt-1.5" (literal dot) breaks label reuse and duplicates errors.
    errorClass: 'form-error-text',
    ignore: ':hidden',
    highlight: function(element) {
        $(element).addClass('border-error-500').removeClass('border-gray-300');
    },
    unhighlight: function(element) {
        $(element).removeClass('border-error-500').addClass('border-gray-300');
    }
});

/**
 * jQuery Validate's built-in "required" only checks value.length > 0, so a
 * field filled with just spaces passes. Add this alongside `required` on
 * any field where whitespace-only input should be rejected.
 */
$.validator.addMethod('notBlank', function(value, element) {
    return this.optional(element) || value.trim().length > 0;
}, 'This field cannot be blank or contain only spaces.');

/**
 * File-extension check for image uploads (core jquery.validate has no
 * built-in "accept"/"extension" method — that only ships in the separate
 * additional-methods.js, which isn't loaded here).
 */
$.validator.addMethod('imageType', function(value, element) {
    return this.optional(element) || /\.(jpe?g|png|webp)$/i.test(value);
}, 'Please upload a JPG, PNG, or WEBP image.');

/**
 * Max upload size in KB, e.g. `maxFileSize: 4096` for a 4MB limit. Mirrors
 * the server's `image|max:4096` rule so oversized files are caught before
 * the request is even sent.
 */
$.validator.addMethod('maxFileSize', function(value, element, param) {
    return this.optional(element) || !element.files[0] || element.files[0].size <= param * 1024;
}, $.validator.format('File size must not exceed {0} KB.'));

/**
 * "Required" check for a CKEditor-backed textarea (see x-forms.richtext).
 * An empty editor still serializes to something like "<p>&nbsp;</p>", so a
 * plain length check on the raw HTML would never fail. Strip tags/entities
 * first and check for real text content.
 */
$.validator.addMethod('richTextRequired', function(value, element) {
    var text = value.replace(/<[^>]*>/g, '').replace(/&nbsp;/gi, ' ').trim();
    return text.length > 0;
}, 'This field is required.');

/**
 * Caps the number of comma-separated values in a tags field (see
 * x-forms.tags-input), e.g. `maxTags: 6`.
 */
$.validator.addMethod('maxTags', function(value, element, param) {
    var count = value.split(',').map(function(t) { return t.trim(); }).filter(Boolean).length;
    return this.optional(element) || count <= param;
}, $.validator.format('Please add no more than {0} values.'));
