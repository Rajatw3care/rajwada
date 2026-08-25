<x-ui.section-eyebrow label="Gallery Image" />

<div class="grid grid-cols-1 gap-5">
    <x-forms.file label="Image" name="image" :current="$galleryImage->image ?? null" :required="!isset($galleryImage)" />
    <x-forms.input label="Title" name="title" :value="$galleryImage->title ?? ''" />
    <x-forms.input label="Alt Text (for accessibility/SEO)" name="alt_text" :value="$galleryImage->alt_text ?? ''" />

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
        <x-forms.select label="Category" name="category" :options="['royal' => 'Royal', 'destination' => 'Destination', 'haldi' => 'Haldi', 'mehendi' => 'Mehendi', 'sangeet' => 'Sangeet', 'reception' => 'Reception']" :selected="$galleryImage->category ?? 'royal'" />
        <x-forms.input label="Display Order" name="sort_order" type="number" :value="$galleryImage->sort_order ?? 0" />
        <x-forms.select label="Status" name="is_active" :options="[1 => 'Active', 0 => 'Inactive']" :selected="(int) ($galleryImage->is_active ?? true)" />
    </div>
</div>
