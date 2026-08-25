@props([
    'label' => null,
    'name',
    'value' => '',
    'placeholder' => 'Type a value and press Enter or ,',
    'required' => false,
    'max' => null,
])

@php
    $initialTags = collect(explode(',', old($name, $value) ?? ''))
        ->map(fn ($t) => trim($t))
        ->filter()
        ->values()
        ->all();
@endphp

<div
    x-data="{
        tags: {{ \Illuminate\Support\Js::from($initialTags) }},
        max: {{ $max !== null ? (int) $max : 'null' }},
        draft: '',
        atLimit() {
            return this.max !== null && this.tags.length >= this.max;
        },
        addFromDraft() {
            this.draft.split(',').forEach(part => {
                const t = part.trim();
                if (t && !this.tags.includes(t) && !this.atLimit()) this.tags.push(t);
            });
            this.draft = '';
        },
        removeTag(index) {
            this.tags.splice(index, 1);
        },
        onKeydown(e) {
            if (e.key === 'Enter' || e.key === ',') {
                e.preventDefault();
                this.addFromDraft();
            } else if (e.key === 'Backspace' && this.draft === '' && this.tags.length) {
                this.removeTag(this.tags.length - 1);
            }
        }
    }"
>
    @if ($label)
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            {{ $label }}
            @if ($required)
                <span class="text-error-500">*</span>
            @endif
        </label>
    @endif

    <div
        @click="$refs.tagsDraftInput.focus()"
        class="dark:bg-dark-900 shadow-theme-xs focus-within:border-brand-300 focus-within:ring-brand-500/10 dark:focus-within:border-brand-800 flex w-full flex-wrap items-center gap-2 rounded-lg border border-gray-300 bg-transparent px-3 py-2 focus-within:ring-3 dark:border-gray-700 dark:bg-gray-900"
    >
        <template x-for="(tag, index) in tags" :key="tag">
            <span class="inline-flex items-center gap-1.5 rounded-full bg-brand-50 px-3 py-1 text-sm font-medium text-brand-700 dark:bg-brand-500/10 dark:text-gold-300">
                <span x-text="tag"></span>
                <button type="button" @click="removeTag(index)" class="text-brand-400 hover:text-brand-700 dark:hover:text-gold-100">&times;</button>
            </span>
        </template>

        <input
            type="text"
            x-ref="tagsDraftInput"
            x-model="draft"
            @keydown="onKeydown($event)"
            @blur="addFromDraft()"
            :disabled="atLimit()"
            :placeholder="atLimit() ? 'Limit reached' : '{{ $placeholder }}'"
            class="min-w-[140px] flex-1 border-0 bg-transparent p-1 text-sm text-gray-800 placeholder:text-gray-400 focus:outline-hidden disabled:cursor-not-allowed disabled:placeholder:text-gray-300 dark:text-white/90 dark:placeholder:text-white/30"
        />
    </div>

    @if ($max !== null)
        <p class="mt-1 text-xs text-gray-400" x-text="tags.length + ' / {{ (int) $max }} values'"></p>
    @endif

    <input type="hidden" id="{{ $name }}" name="{{ $name }}" :value="tags.join(', ')" @if($required) required @endif />

    @error($name)
        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>
