@props([
    'name',
    'label',
    'value',
])

@if($label ?? null)
    <label class="{{ ($required ?? false) ? 'label label-required font-medium text-gray-700' : 'label font-medium text-gray-700' }}" for="trixer{{ $name }}">
        {{ $label }}
    </label>
@endif

<div
    x-data="{ trixval{{ $name }}: '{{addslashes($value)}}' }"
    x-init="$refs.trix{{ $name }}.editor.loadHTML(trixval{{ $name }})"
    x-id="['trix{{ $name }}']"
    class="max-w-2xl w-full"
    @trix-change="trixval{{ $name }} = $refs.trixput{{ $name }}.value"
    @trix-file-accept.prevent
>
    <input
        type="hidden"
        name="{{ $name }}"
        :id="$id('trix{{ $name }}')"
        x-ref="trixput{{ $name }}"
    />

    <trix-editor
        x-ref="trix{{ $name }}"
        :input="$id('trix{{ $name }}')"
        {{ $attributes->merge(['class' => 'block appearance-none w-full py-1 px-2 text-base leading-normal text-gray-800 border border-gray-200 rounded']) }}
    ></trix-editor>
</div>

@error($name)
    @include('components.inputs.partials.error')
@enderror
