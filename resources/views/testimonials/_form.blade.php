<x-ui.section-eyebrow label="Testimonial" />

<div class="grid grid-cols-1 gap-5">
    <x-forms.file label="Avatar" name="avatar" :current="$testimonial->avatar ?? null" required />
    <x-forms.input label="Client Name" name="name" :value="$testimonial->name ?? ''" required />
    <x-forms.textarea label="Message" name="message" :value="$testimonial->message ?? ''" required />
    <x-forms.input label="Event Label (e.g. Royal Wedding, Jaipur)" name="event_label" :value="$testimonial->event_label ?? ''" required />

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
        <x-forms.select label="Rating" name="rating" :options="[5 => '5 Stars', 4 => '4 Stars', 3 => '3 Stars', 2 => '2 Stars', 1 => '1 Star']" :selected="$testimonial->rating ?? 5" required />
        <x-forms.input label="Display Order" name="sort_order" type="number" :value="$testimonial->sort_order ?? 0" min="0" step="1" />
        <x-forms.select label="Status" name="is_active" :options="[1 => 'Active', 0 => 'Inactive']" :selected="(int) ($testimonial->is_active ?? true)" />
    </div>

    <x-forms.checkbox label="Featured review (shown in Featured Reviews section)" name="is_featured" :checked="$testimonial->is_featured ?? false" />
</div>
