@props([
    'trixId',
    'name',
    'label',
    'value',
])

{{-- source: https://devdojo.com/tnylea/laravel-livewire-trix-editor-component --}}

@if($label ?? null)
    <label class="{{ ($required ?? false) ? 'label label-required font-medium text-gray-700' : 'label font-medium text-gray-700' }}">
        {{ $label }}
    </label>
@endif

<div wire:ignore>
    <input
        type="hidden"
        id="{{ $trixId }}"
        name="{{ $name }}"
        value="{{ $value }}"
    />

    <trix-editor
        wire:ignore
        input="{{ $trixId }}"
    ></trix-editor>
</div>

@push('scripts')
    <script>
        var trixEditor = document.getElementById("{{ $trixId }}")

        addEventListener("trix-blur", function(event) {
        @this.set('subw_y_s_i_w_y_g', trixEditor.getAttribute('value'))
        })
    </script>
@endpush

@error($name)
    @include('components.inputs.partials.error')
@enderror
