<x-forms.file label="Logo" name="logo" :current="$partner->logo ?? null" :required="!isset($partner)" />
<x-forms.input label="Partner Name" name="name" :value="$partner->name ?? ''" required />
<div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
    <x-forms.input label="Sort Order" name="sort_order" type="number" :value="$partner->sort_order ?? 0" />
    <x-forms.select label="Status" name="is_active" :options="[1 => 'Active', 0 => 'Inactive']" :selected="(int) ($partner->is_active ?? true)" />
</div>
