@php $editing = isset($userActivityLog) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.date
            name="at"
            label="At"
            value="{{ old('at', ($editing ? optional($userActivityLog->at)->format('Y-m-d') : '')) }}"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
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
            label="Title"
            :value="old('title', ($editing ? $userActivityLog->title : ''))"
            maxlength="255"
            placeholder="Title"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="link" label="Link"
            >{{ old('link', ($editing ? $userActivityLog->link : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="message" label="Message"
            >{{ old('message', ($editing ? $userActivityLog->message : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="i_p_address"
            label="I P Address"
            :value="old('i_p_address', ($editing ? $userActivityLog->i_p_address : ''))"
            maxlength="255"
            placeholder="I P Address"
        ></x-inputs.text>
    </x-inputs.group>
</div>
