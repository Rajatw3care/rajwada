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

    <x-forms.input label="Published Date" name="published_at" type="date" :value="optional($blogPost->published_at ?? null)->format('Y-m-d')" />
    <p class="-mt-3 text-xs text-gray-400">Controls the date shown on the site and the order posts appear in. Leave blank to use today's date.</p>

    <x-forms.checkbox label="Featured post (shown at top of Blogs page)" name="is_featured" :checked="$blogPost->is_featured ?? false" />

    <x-ui.section-eyebrow label="Share Icons" />
    <p class="-mt-3 text-xs text-gray-400">Links used by the Share buttons on this post's page. Leave a field blank to hide that icon.</p>
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
        <x-forms.input label="Facebook URL" name="share_facebook_url" :value="$blogPost->share_facebook_url ?? ''" placeholder="https://facebook.com/..." />
        <x-forms.input label="X / Twitter URL" name="share_twitter_url" :value="$blogPost->share_twitter_url ?? ''" placeholder="https://x.com/..." />
        <x-forms.input label="WhatsApp URL" name="share_whatsapp_url" :value="$blogPost->share_whatsapp_url ?? ''" placeholder="https://wa.me/..." />
        <x-forms.input label="Email" name="share_email_url" type="email" :value="$blogPost->share_email_url ?? ''" placeholder="someone@example.com" />
    </div>
</div>
