@php $editing = isset($userActivityLog) @endphp

<x-partials.card>
    {{--
    <x-slot name="title">
        <span>@lang('card.title')</span>
    </x-slot>
    --}}

    <div class="flex flex-wrap">
        <x-inputs.group class="w-full">
            <x-inputs.date
                name="at"
                label="{{ __('crud.user_activity_logs.inputs.at') }}"
                value="{{ old('at', ($editing ? optional($userActivityLog->at)->format('Y-m-d') : '')) }}"
                required
            ></x-inputs.date>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.select
                name="user_id"
                label="{{ __('crud.user_activity_logs.inputs.user_id') }}"
                required
            >
                @php $selected = old('user_id', ($editing ? $userActivityLog->user_id : '')) @endphp
                <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
                @foreach($users as $value => $label)
                    <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
                @endforeach
            </x-inputs.select>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.text
                name="title"
                label="{{ __('crud.user_activity_logs.inputs.title') }}"
                :value="old('title', ($editing ? $userActivityLog->title : ''))"
                maxlength="255"
                placeholder="{{ __('crud.user_activity_logs.inputs.title') }}"
                required
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.url
                name="link"
                label="{{ __('crud.user_activity_logs.inputs.link') }}"
                :value="old('link', ($editing ? $userActivityLog->link : ''))"
                placeholder="{{ __('crud.user_activity_logs.inputs.link') }}"
            ></x-inputs.url>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.textarea
                name="message"
                label="{{ __('crud.user_activity_logs.inputs.message') }}"
            >
                {{ old('message', ($editing ? $userActivityLog->message : ''))
                }}
            </x-inputs.textarea>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.text
                name="i_p_address"
                label="{{ __('crud.user_activity_logs.inputs.i_p_address') }}"
                :value="old('i_p_address', ($editing ? $userActivityLog->i_p_address : ''))"
                maxlength="255"
                placeholder="{{ __('crud.user_activity_logs.inputs.i_p_address') }}"
            ></x-inputs.text>
        </x-inputs.group>
    </div>
</x-partials.card>
