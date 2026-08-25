<x-ui.section-eyebrow label="Rating Stat" />

<div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
    <x-forms.input label="Icon (emoji, e.g. ⭐)" name="icon" :value="$ratingStat->icon ?? ''" />
    <x-forms.input label="Number (e.g. 4.9/5)" name="number" :value="$ratingStat->number ?? ''" required />

    <div class="sm:col-span-2">
        <x-forms.input label="Label" name="label" :value="$ratingStat->label ?? ''" required />
    </div>

    <x-forms.input label="Display Order" name="sort_order" type="number" :value="$ratingStat->sort_order ?? 0" />
</div>
