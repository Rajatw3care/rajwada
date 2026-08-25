$(function() {
    $('#visionMissionForm').validate({
        // The Core Values tags widget stores its value in a native
        // `type="hidden"` input, which the shared `ignore: ':hidden'`
        // default would skip — override to validate it here.
        ignore: [],
        rules: {
            vision: {
                required: true,
                notBlank: true,
                maxlength: 200
            },
            mission: {
                required: true,
                notBlank: true,
                maxlength: 200
            },
            core_values: {
                required: true,
                notBlank: true,
                maxTags: 6
            }
        },
        messages: {
            vision: { required: 'Our Vision is required', notBlank: 'Our Vision cannot be blank spaces', maxlength: 'Our Vision must not exceed 200 characters' },
            mission: { required: 'Our Mission is required', notBlank: 'Our Mission cannot be blank spaces', maxlength: 'Our Mission must not exceed 200 characters' },
            core_values: { required: 'Please add at least one core value', notBlank: 'Core Values cannot be blank spaces', maxTags: 'Please add no more than 6 core values' }
        }
    });
});
