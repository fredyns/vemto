@props([
'name',
'label',
'value',
'type' => 'text',
'min' => null,
'max' => null,
'step' => null,
])

@if($label ?? null)
    @include('components.inputs.partials.label')
@endif

<div x-data="{ slider{{ $name }}: {{ old($name, $value ?? $min ?? 0) }} }">

    <input
        type="number"
        id="{{ $name }}"
        name="{{ $name }}"
        x-model="slider{{ $name }}"
        {{ ($required ?? false) ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'block appearance-none w-full py-1 px-2 text-base leading-normal text-gray-800 border border-gray-200 rounded']) }}
        {{ $min ? "min={$min}" : '' }}
        {{ $max ? "max={$max}" : '' }}
        {{ $step ? "step={$step}" : '' }}
        autocomplete="off"
    />
    <input
        type="range"
        id="sliding{{ $name }}"
        name="sliding{{ $name }}"
        x-model="slider{{ $name }}"
        {{ $min ? "min={$min}" : '' }}
        {{ $max ? "max={$max}" : '' }}
        {{ $step ? "step={$step}" : '' }}
        class="mt-3"
        style="width: 100%;"
    />

</div>
@error($name)
@include('resources.views.components.inputs.partials.error')
@enderror
