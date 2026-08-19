<x-forms.file label="Icon" name="icon" :current="$service->icon ?? null" />
<x-forms.input label="Title" name="title" :value="$service->title ?? ''" required />
<x-forms.textarea label="Description" name="description" :value="$service->description ?? ''" />
<x-forms.input label="Sort Order" name="sort_order" type="number" :value="$service->sort_order ?? 0" />
<x-forms.checkbox label="Active (visible on site)" name="is_active" :checked="$service->is_active ?? true" />
