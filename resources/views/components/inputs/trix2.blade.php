@props([
    'name',
    'label',
    'value',
])

@if($label ?? null)
    <label class="{{ ($required ?? false) ? 'label label-required font-medium text-gray-700' : 'label font-medium text-gray-700' }}">
        {{ $label }}
    </label>
@endif

<div
    wire:ignore
    x-data="{ value: '{{addslashes($value)}}' }"
    x-init="$refs.trix.editor.loadHTML(value)"
    x-id="['trix']"
    class="max-w-2xl w-full"
    @trix-change="value = $refs.input.value"
    @trix-file-accept.prevent
>
    <input
        wire:ignore
        type="hidden"
        name="{{ $name }}"
        :id="$id('trix')"
        x-ref="input"
    />

    <trix-editor
        wire:ignore
        x-ref="trix"
        :input="$id('trix')"
        {{ $attributes->merge(['class' => 'block appearance-none w-full py-1 px-2 text-base leading-normal text-gray-800 border border-gray-200 rounded']) }}
    ></trix-editor>
</div>

@push('scripts')
    <script>
        let trixInput = document.getElementById("{{ $name }}")

        addEventListener("trix-blur", function(event) {
        @this.set('{{ $name }}', trixInput.getAttribute('value'))
        })
    </script>
@endpush

@error($name)
    @include('components.inputs.partials.error')
@enderror
