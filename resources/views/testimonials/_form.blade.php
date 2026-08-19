<x-forms.file label="Avatar" name="avatar" :current="$testimonial->avatar ?? null" />
<x-forms.input label="Name" name="name" :value="$testimonial->name ?? ''" required />
<x-forms.textarea label="Message" name="message" :value="$testimonial->message ?? ''" required />
<x-forms.input label="Sort Order" name="sort_order" type="number" :value="$testimonial->sort_order ?? 0" />
<x-forms.checkbox label="Active (visible on site)" name="is_active" :checked="$testimonial->is_active ?? true" />
