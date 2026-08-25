<x-ui.section-eyebrow label="Destination" />

<div class="grid grid-cols-1 gap-5">
    <x-forms.file label="Image" name="image" :current="$destination->image ?? null" :required="!isset($destination)" />
    <x-forms.input label="Destination Name (e.g. Jaipur)" name="name" :value="$destination->name ?? ''" required />
    <x-forms.input label="Count Label (e.g. 18+ Celebrations)" name="count_label" :value="$destination->count_label ?? ''" />

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
        <x-forms.input label="Display Order" name="sort_order" type="number" :value="$destination->sort_order ?? 0" />
        <x-forms.select label="Status" name="is_active" :options="[1 => 'Active', 0 => 'Inactive']" :selected="(int) ($destination->is_active ?? true)" />
    </div>
</div>
