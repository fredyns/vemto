@php $editing = isset($userActivityLog) @endphp

<style>
    .ts-control {
        border: none;
        padding: 0;
    }

    .ts-dropdown,
    .ts-control,
    .ts-control input {
        color: rgb(31 41 55 / var(--tw-text-opacity));
        font-family: inherit;
        font-size: 1rem;
        line-height: 1.5;
    }
</style>

<x-partials.card>
    {{--
    <x-slot name="title">
        <span>@lang('card.title')</span>
    </x-slot>
    --}}

    <div class="flex flex-wrap">
        <x-inputs.group class="w-full">
            <x-inputs.datetime
                name="at"
                value="{{ old('at', ($editing ? optional($userActivityLog->at)->format('Y-m-d H:i:s') : '')) }}"
                label="{{ __('crud.user_activity_logs.inputs.at') }}"
                placeholder="{{ __('crud.user_activity_logs.inputs.at') }}"
                required
            ></x-inputs.datetime>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.tomselect
                name="user_id"
                label="{{ __('crud.user_activity_logs.inputs.user_id') }}"
                required
            >
                @php $selected = old('user_id', ($editing ? $userActivityLog->user_id : '')) @endphp
                <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
                @foreach($users as $value => $label)
                    <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
                @endforeach
            </x-inputs.tomselect>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.text
                name="title"
                :value="old('title', ($editing ? $userActivityLog->title : ''))"
                label="{{ __('crud.user_activity_logs.inputs.title') }}"
                placeholder="{{ __('crud.user_activity_logs.inputs.title') }}"
                maxlength="255"
                required
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.url
                name="link"
                :value="old('link', ($editing ? $userActivityLog->link : ''))"
                label="{{ __('crud.user_activity_logs.inputs.link') }}"
                placeholder="{{ __('crud.user_activity_logs.inputs.link') }}"
            ></x-inputs.url>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.textarea
                name="message"
                label="{{ __('crud.user_activity_logs.inputs.message') }}"
                placeholder="{{ __('crud.user_activity_logs.inputs.message') }}"
            >
                {{ old('message', ($editing ? $userActivityLog->message : '')) }}
            </x-inputs.textarea>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.text
                name="i_p_address"
                :value="old('i_p_address', ($editing ? $userActivityLog->i_p_address : ''))"
                label="{{ __('crud.user_activity_logs.inputs.i_p_address') }}"
                placeholder="{{ __('crud.user_activity_logs.inputs.i_p_address') }}"
                maxlength="255"
            ></x-inputs.text>
        </x-inputs.group>
    </div>
</x-partials.card>
