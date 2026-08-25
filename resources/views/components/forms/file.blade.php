@props([
    'label' => null,
    'name',
    'current' => null,
    'required' => false,
])

<div x-data="{
    fileName: null,
    previewUrl: {{ $current ? "'".asset('storage/'.$current)."'" : 'null' }},
    dragging: false,
    handleFiles(files) {
        if (!files || !files.length) return;
        const file = files[0];
        this.fileName = file.name;
        this.previewUrl = URL.createObjectURL(file);
        const dt = new DataTransfer();
        dt.items.add(file);
        this.$refs.input.files = dt.files;
    }
}">
    @if ($label)
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            {{ $label }}
            @if ($required)
                <span class="text-error-500">*</span>
            @endif
        </label>
    @endif

    <div
        class="dropzone-royal"
        :class="{ 'border-gold-400 bg-brand-50/60 dark:bg-white/[0.06]': dragging }"
        @click="$refs.input.click()"
        @dragover.prevent="dragging = true"
        @dragleave.prevent="dragging = false"
        @drop.prevent="dragging = false; handleFiles($event.dataTransfer.files)"
    >
        <template x-if="previewUrl">
            <img :src="previewUrl" alt="" class="mb-1 h-20 w-20 rounded-lg border border-gold-300/40 object-cover">
        </template>
        <template x-if="!previewUrl">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" class="text-brand-400" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 16.5V18a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1.5M7 9l5-5 5 5M12 4v12" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </template>
        <p class="text-sm font-medium text-brand-700 dark:text-gold-300" x-text="fileName || 'Drag & drop your image here'"></p>
        <p class="text-xs text-gray-400" x-show="!fileName">or <span class="underline">browse files</span> &mdash; JPG, PNG, WEBP</p>
    </div>

    <input
        x-ref="input"
        type="file"
        id="{{ $name }}"
        name="{{ $name }}"
        accept="image/*"
        class="hidden"
        @change="handleFiles($event.target.files)"
        @if($required && !$current) required @endif
    />

    @error($name)
        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>
