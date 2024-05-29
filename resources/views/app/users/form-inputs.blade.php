@php $editing = isset($user) @endphp

<x-partials.card>
    {{--
    <x-slot name="title">
        <span>@lang('card.title')</span>
    </x-slot>
    --}}

    <div class="flex flex-wrap">
        <x-inputs.group class="w-full">
            <x-inputs.text
                name="name"
                label="{{ __('crud.users.inputs.name') }}"
                :value="old('name', ($editing ? $user->name : ''))"
                maxlength="255"
                placeholder="{{ __('crud.users.inputs.name') }}"
                required
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.email
                name="email"
                label="{{ __('crud.users.inputs.email') }}"
                :value="old('email', ($editing ? $user->email : ''))"
                maxlength="255"
                placeholder="{{ __('crud.users.inputs.email') }}"
                required
            ></x-inputs.email>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.password
                name="password"
                label="{{ __('crud.users.inputs.password') }}"
                maxlength="255"
                placeholder="{{ __('crud.users.inputs.password') }}"
                :required="!$editing"
            ></x-inputs.password>
        </x-inputs.group>
    </div>
</x-partials.card>
