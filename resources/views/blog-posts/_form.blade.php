<x-ui.section-eyebrow label="Story Details" />

<div class="grid grid-cols-1 gap-5">
    <x-forms.file label="Image" name="image" :current="$blogPost->image ?? null" :required="!isset($blogPost)" />
    <x-forms.input label="Title" name="title" :value="$blogPost->title ?? ''" required />
    <x-forms.input label="Venue" name="venue" :value="$blogPost->venue ?? ''" />
    <x-forms.textarea label="Excerpt" name="excerpt" :value="$blogPost->excerpt ?? ''" :rows="3" />
    <x-forms.textarea label="Body" name="body" :value="$blogPost->body ?? ''" :rows="8" />

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
        <x-forms.input label="Display Order" name="sort_order" type="number" :value="$blogPost->sort_order ?? 0" />
        <x-forms.select label="Status" name="is_active" :options="[1 => 'Published', 0 => 'Draft']" :selected="(int) ($blogPost->is_active ?? true)" />
    </div>
</div>
