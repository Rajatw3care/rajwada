<x-ui.section-eyebrow label="Testimonial" />

<div class="grid grid-cols-1 gap-5">
    <x-forms.file label="Avatar" name="avatar" :current="$testimonial->avatar ?? null" />
    <x-forms.input label="Client Name" name="name" :value="$testimonial->name ?? ''" required />
    <x-forms.textarea label="Message" name="message" :value="$testimonial->message ?? ''" required />

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
        <x-forms.input label="Display Order" name="sort_order" type="number" :value="$testimonial->sort_order ?? 0" />
        <x-forms.select label="Status" name="is_active" :options="[1 => 'Active', 0 => 'Inactive']" :selected="(int) ($testimonial->is_active ?? true)" />
    </div>
</div>
