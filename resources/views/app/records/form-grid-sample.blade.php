@php $editing = isset($record) @endphp

<x-partials.card class="mt-5">
    <x-slot name="title">
        <span>Form Grid Sample</span>
    </x-slot>

    <div class="flex flex-wrap">
        <x-inputs.group class="w-full md:w-6/12 lg:w-1/12">
            <x-inputs.text
                name="string1"
                label="M6/L1"
                placeholder="md:w-6/12 lg:w-1/12"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full md:w-6/12 lg:w-2/12">
            <x-inputs.text
                name="string2"
                label="M6/L2"
                placeholder="md:w-6/12 lg:w-2/12"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full md:w-4/12 lg:w-3/12">
            <x-inputs.text
                name="string3"
                label="M4/L3"
                placeholder="md:w-4/12 lg:w-3/12"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full md:w-4/12 lg:w-6/12">
            <x-inputs.text
                name="string4"
                label="M4/L6"
                placeholder="md:w-4/12 lg:w-6/12"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full md:w-4/12">
            <x-inputs.text
                name="string5"
                label="M4/L*"
                placeholder="md:w-4/12"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full md:w-3/12 lg:w-4/12">
            <x-inputs.text
                name="string6"
                label="M3/L4"
                placeholder="md:w-3/12 lg:w-4/12"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full md:w-3/12 lg:w-4/12">
            <x-inputs.text
                name="string7"
                label="M3/L4"
                placeholder="md:w-3/12 lg:w-4/12"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full md:w-3/12">
            <x-inputs.text
                name="string8"
                label="M3/L*"
                placeholder="md:w-3/12"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full md:w-3/12">
            <x-inputs.text
                name="string9"
                label="M3/L*"
                placeholder="md:w-3/12"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full md:w-2/12 lg:w-3/12">
            <x-inputs.text
                name="string10"
                label="M2/L3"
                placeholder="md:w-2/12 lg:w-3/12"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full md:w-1/12 lg:w-3/12">
            <x-inputs.text
                name="string11"
                label="M1/L3"
                placeholder="md:w-1/12 lg:w-3/12"
            ></x-inputs.text>
        </x-inputs.group>
    </div>
</x-partials.card>
