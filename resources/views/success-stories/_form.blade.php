<x-ui.section-eyebrow label="Success Story" />

<div class="grid grid-cols-1 gap-5">
    <x-forms.file label="Image" name="image" :current="$successStory->image ?? null" required />
    <x-forms.input label="Title" name="title" :value="$successStory->title ?? ''" required />
    <x-forms.input label="Location" name="location" :value="$successStory->location ?? ''" required />
    <x-forms.textarea label="Description" name="description" :value="$successStory->description ?? ''" required />

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
        <x-forms.input label="Display Order" name="sort_order" type="number" :value="$successStory->sort_order ?? 0" min="0" step="1" />
        <x-forms.select label="Status" name="is_active" :options="[1 => 'Active', 0 => 'Inactive']" :selected="(int) ($successStory->is_active ?? true)" />
    </div>
</div>
