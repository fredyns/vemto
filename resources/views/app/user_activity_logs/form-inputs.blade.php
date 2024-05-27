@php $editing = isset($userActivityLog) @endphp

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <x-partials.card>
        <x-slot name="title">
            <a href="javascript: history.go(-1)" class="mr-4">
                <i class="mr-1 icon ion-md-arrow-back"></i>
            </a>
            <span>@lang('app.containers.sections.general')</span>
        </x-slot>

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
                <x-inputs.textarea
                    name="link"
                    label="{{ __('crud.user_activity_logs.inputs.link') }}"
                    >{{ old('link', ($editing ? $userActivityLog->link : ''))
                    }}</x-inputs.textarea
                >
            </x-inputs.group>

            <x-inputs.group class="w-full">
                <x-inputs.textarea
                    name="message"
                    label="{{ __('crud.user_activity_logs.inputs.message') }}"
                    >{{ old('message', ($editing ? $userActivityLog->message :
                    '')) }}</x-inputs.textarea
                >
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
</div>
