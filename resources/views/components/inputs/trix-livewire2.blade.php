@props([
    'name',
    'label',
    'value',
])

{{-- source: https://devdojo.com/tnylea/laravel-livewire-trix-editor-component --}}

@if($label ?? null)
    <label
        class="{{ ($required ?? false) ? 'label label-required font-medium text-gray-700' : 'label font-medium text-gray-700' }}"
        for="trix_{{ $name }}"
    >
        {{ $label }}
    </label>
@endif

<div wire:ignore>
    <input
        type="hidden"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $value }}"
    />

    <trix-editor
        wire:ignore
        id="trix_{{ $name }}"
        input="{{ $name }}"
        x-ref="trix_{{ $name }}"
        @trix-file-accept.prevent
        {{ $attributes->merge(['class' => 'block appearance-none w-full py-1 px-2 text-base leading-normal text-gray-800 border border-gray-200 rounded']) }}
    ></trix-editor>
</div>

@push('scripts')
    <script>
        let trixInput = document.getElementById("{{ $name }}")
        let trixEditor = document.getElementById("trix_{{ $name }}")

        Livewire.on('editSubrecord', subrecordId => {
            // alert('A post was added with the id of: ' + subrecordId);
            var element = document.querySelector("trix-editor")
            element.editor.loadHTML(trixInput.value);
        })

        addEventListener("trix-blur", function(event) {
            @this.set('{{ $name }}', trixInput.getAttribute('value'))
        })
    </script>
@endpush

@error($name)
    @include('components.inputs.partials.error')
@enderror
