@props([
    'label' => null,
    'name',
    'value' => '',
    'required' => false,
])

@if ($label)
    <label for="{{ $name }}" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
        {{ $label }}
        @if ($required)
            <span class="text-error-500">*</span>
        @endif
    </label>
@endif

<textarea id="{{ $name }}" name="{{ $name }}" @if($required) required @endif class="hidden">{{ old($name, $value) }}</textarea>
<div id="{{ $name }}-mount" class="richtext-mount rounded-lg border border-gray-300 dark:border-gray-700"></div>

@error($name)
    <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
@enderror

@once
    @push('scripts')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ckeditor5@48.4.0/dist/browser/ckeditor5.css">
        <script src="https://cdn.jsdelivr.net/npm/ckeditor5@48.4.0/dist/browser/ckeditor5.umd.js"></script>
        <style>
            .richtext-mount .ck-editor__editable { min-height: 220px; }
            .richtext-mount .ck.ck-editor__top .ck-sticky-panel__content { border-radius: 0.5rem 0.5rem 0 0; }
            .richtext-mount .ck.ck-content { border-radius: 0 0 0.5rem 0.5rem; }
            .richtext-mount .ck.ck-editor__main > .ck-editor__editable { border-radius: 0 0 0.5rem 0.5rem; }
            .richtext-mount .ck.ck-toolbar { border-radius: 0.5rem 0.5rem 0 0; }
            :root { --ck-color-focus-border: #a3202b; --ck-border-radius: 0.5rem; }
        </style>
    @endpush
@endonce

@push('scripts')
    <script>
        (function () {
            function initEditor() {
                var sourceEl = document.getElementById('{{ $name }}');
                var mountEl = document.getElementById('{{ $name }}-mount');
                if (!sourceEl || !mountEl || !window.CKEDITOR) return;
                var { ClassicEditor, Essentials, Paragraph, Bold, Italic, Heading, Link, List, BlockQuote, Undo } = window.CKEDITOR;
                mountEl.innerHTML = sourceEl.value;
                ClassicEditor.create(mountEl, {
                    licenseKey: 'GPL',
                    plugins: [Essentials, Paragraph, Bold, Italic, Heading, Link, List, BlockQuote, Undo],
                    toolbar: ['undo', 'redo', '|', 'heading', '|', 'bold', 'italic', 'link', '|', 'bulletedList', 'numberedList', '|', 'blockQuote'],
                }).then(function (editor) {
                    // Keep the hidden textarea live-synced (not just on submit) so
                    // anything reading sourceEl.value — e.g. jQuery Validate —
                    // always sees the current editor content.
                    var sync = function () { sourceEl.value = editor.getData(); };
                    editor.model.document.on('change:data', sync);
                    var form = sourceEl.closest('form');
                    if (form) {
                        form.addEventListener('submit', sync);
                    }
                }).catch(function (err) { console.error('CKEditor init failed', err); });
            }
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initEditor);
            } else {
                initEditor();
            }
        })();
    </script>
@endpush
