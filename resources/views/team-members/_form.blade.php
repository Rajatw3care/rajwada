<x-forms.file label="Photo" name="photo" :current="$teamMember->photo ?? null" />
<x-forms.input label="Name" name="name" :value="$teamMember->name ?? ''" required />
<x-forms.input label="Role" name="role" :value="$teamMember->role ?? ''" />
<x-forms.textarea label="Description" name="description" :value="$teamMember->description ?? ''" />
<div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
    <x-forms.input label="Sort Order" name="sort_order" type="number" :value="$teamMember->sort_order ?? 0" />
    <x-forms.select label="Status" name="is_active" :options="[1 => 'Active', 0 => 'Inactive']" :selected="(int) ($teamMember->is_active ?? true)" />
</div>
