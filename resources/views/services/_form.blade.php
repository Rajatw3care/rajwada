<x-ui.section-eyebrow label="Service Information" />

<div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
    <div class="sm:col-span-2">
        <x-forms.file label="Icon" name="icon" :current="$service->icon ?? null" />
    </div>

    <div class="sm:col-span-2">
        <x-forms.input label="Service Title" name="title" :value="$service->title ?? ''" required />
    </div>

    <div class="sm:col-span-2">
        <x-forms.textarea label="Description" name="description" :value="$service->description ?? ''" />
    </div>

    <div class="sm:col-span-2">
        <x-forms.file label="Overview Image (for /services page listing)" name="overview_image" :current="$service->overview_image ?? null" />
    </div>

    <div class="sm:col-span-2">
        <x-forms.textarea label="Overview Description (for /services page listing)" name="overview_description" :value="$service->overview_description ?? ''" />
    </div>

    <x-forms.input label="Display Order" name="sort_order" type="number" :value="$service->sort_order ?? 0" />
    <x-forms.select label="Status" name="is_active" :options="[1 => 'Active', 0 => 'Inactive']" :selected="(int) ($service->is_active ?? true)" />

    <div class="sm:col-span-2">
        <x-forms.checkbox label="Show on homepage teaser (top 8 curated services)" name="show_on_homepage" :checked="$service->show_on_homepage ?? true" />
    </div>
</div>
