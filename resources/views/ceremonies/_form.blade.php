<x-forms.file label="Icon" name="icon" :current="$ceremony->icon ?? null" :required="!isset($ceremony)" />
<x-forms.input label="Title" name="title" :value="$ceremony->title ?? ''" required />
<x-forms.textarea label="Description" name="description" :value="$ceremony->description ?? ''" required />
<div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
    <x-forms.input label="Sort Order" name="sort_order" type="number" :value="$ceremony->sort_order ?? 0" min="0" step="1" />
    <x-forms.select label="Status" name="is_active" :options="[1 => 'Active', 0 => 'Inactive']" :selected="(int) ($ceremony->is_active ?? true)" />
</div>
