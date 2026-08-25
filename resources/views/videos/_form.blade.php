<x-ui.section-eyebrow label="Video Details" />

<div class="grid grid-cols-1 gap-5">
    <x-forms.file label="Thumbnail" name="thumbnail" :current="$video->thumbnail ?? null" required />
    <x-forms.input label="Title" name="title" :value="$video->title ?? ''" required />
    <x-forms.input label="Video URL (YouTube/Vimeo embed link)" name="video_url" :value="$video->video_url ?? ''" required />

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
        <x-forms.select label="Shown On" name="category" :options="['gallery' => 'Video Gallery', 'testimonial' => 'Video Testimonials']" :selected="$video->category ?? 'gallery'" required />
        <x-forms.tags-input label="Tag" name="tag" :value="$video->tag ?? ''" :max="5" placeholder="e.g. Royal Wedding" />
    </div>

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
        <x-forms.input label="Duration (e.g. 3:45)" name="duration" :value="$video->duration ?? ''" required />
        <x-forms.input label="Display Order" name="sort_order" type="number" :value="$video->sort_order ?? 0" min="0" step="1" />
    </div>

    <x-forms.select label="Status" name="is_active" :options="[1 => 'Active', 0 => 'Inactive']" :selected="(int) ($video->is_active ?? true)" />
</div>
