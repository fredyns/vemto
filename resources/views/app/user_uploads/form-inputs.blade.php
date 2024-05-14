@php $editing = isset($userUpload) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $userUpload->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="at"
            label="At"
            value="{{ old('at', ($editing ? optional($userUpload->at)->format('Y-m-d') : '')) }}"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.partials.label
            name="file"
            label="File"
        ></x-inputs.partials.label
        ><br />

        <input type="file" name="file" id="file" class="form-control-file" />

        @if($editing && $userUpload->file)
        <div class="mt-2">
            <a href="{{ \Storage::url($userUpload->file) }}" target="_blank"
                ><i class="icon ion-md-download"></i>&nbsp;Download</a
            >
        </div>
        @endif @error('file') @include('components.inputs.partials.error')
        @enderror
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $userUpload->name : ''))"
            maxlength="255"
            placeholder="Name"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="description" label="Description"
            >{{ old('description', ($editing ? $userUpload->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="type"
            label="Type"
            :value="old('type', ($editing ? $userUpload->type : ''))"
            maxlength="255"
            placeholder="Type"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="metadata" label="Metadata"
            >{{ old('metadata', ($editing ? json_encode($userUpload->metadata) :
            '')) }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
