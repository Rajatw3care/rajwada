<x-forms.file label="Image" name="image" :current="$blogPost->image ?? null" :required="!isset($blogPost)" />
<x-forms.input label="Title" name="title" :value="$blogPost->title ?? ''" required />
<x-forms.input label="Venue" name="venue" :value="$blogPost->venue ?? ''" />
<x-forms.textarea label="Excerpt" name="excerpt" :value="$blogPost->excerpt ?? ''" :rows="3" />
<x-forms.textarea label="Body" name="body" :value="$blogPost->body ?? ''" :rows="8" />
<x-forms.input label="Sort Order" name="sort_order" type="number" :value="$blogPost->sort_order ?? 0" />
<x-forms.checkbox label="Published (visible on site)" name="is_active" :checked="$blogPost->is_active ?? true" />
