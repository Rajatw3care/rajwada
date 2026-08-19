<x-forms.file label="Image" name="image" :current="$galleryImage->image ?? null" :required="!isset($galleryImage)" />
<x-forms.input label="Alt Text (for accessibility/SEO)" name="alt_text" :value="$galleryImage->alt_text ?? ''" />
<x-forms.input label="Sort Order" name="sort_order" type="number" :value="$galleryImage->sort_order ?? 0" />
<x-forms.checkbox label="Active (visible on site)" name="is_active" :checked="$galleryImage->is_active ?? true" />
