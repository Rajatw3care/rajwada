<x-ui.section-eyebrow label="Story Details" />

<div class="grid grid-cols-1 gap-5">
    <x-forms.file label="Image" name="image" :current="$blogPost->image ?? null" required />
    <x-forms.input label="Title" name="title" :value="$blogPost->title ?? ''" required />
    <x-forms.input label="Venue" name="venue" :value="$blogPost->venue ?? ''" required />
    <x-forms.textarea label="Excerpt" name="excerpt" :value="$blogPost->excerpt ?? ''" :rows="3" required />
    <x-forms.richtext label="Body" name="body" :value="$blogPost->body ?? ''" required />

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
        <x-forms.input label="Category" name="category" :value="$blogPost->category ?? ''" required />
        <x-forms.tags-input label="Tags" name="tags" :value="$blogPost->tags ?? ''" :max="5" placeholder="comma separated, e.g. Mehendi" />
    </div>

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
        <x-forms.input label="Display Order" name="sort_order" type="number" :value="$blogPost->sort_order ?? 0" min="0" step="1" />
        <x-forms.select label="Status" name="is_active" :options="[1 => 'Published', 0 => 'Draft']" :selected="(int) ($blogPost->is_active ?? true)" />
    </div>

    <x-forms.checkbox label="Featured post (shown at top of Blogs page)" name="is_featured" :checked="$blogPost->is_featured ?? false" />
</div>
