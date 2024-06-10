@php $editing = isset($userUpload) @endphp

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
            <x-inputs.tomselect
                name="user_id"
                label="{{ __('crud.user_uploads.inputs.user_id') }}"
                required
            >
                @php $selected = old('user_id', ($editing ? $userUpload->user_id : '')) @endphp
                <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
                @foreach($users as $value => $label)
                    <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
                @endforeach
            </x-inputs.tomselect>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.date
                name="at"
                value="{{ old('at', ($editing ? optional($userUpload->at)->format('Y-m-d') : '')) }}"
                label="{{ __('crud.user_uploads.inputs.at') }}"
                placeholder="{{ __('crud.user_uploads.inputs.at') }}"
                required
            ></x-inputs.date>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.partials.label
                name="file"
                label="{{ __('crud.user_uploads.inputs.file') }}"
            ></x-inputs.partials.label>
            <br/>

            <input
                type="file"
                name="file"
                id="file"
                class="form-control-file"
            />

            @if($editing && $userUpload->file)
                <div class="mt-2">
                    <a
                        href="{{ Storage::url($userUpload->file) }}"
                        target="_blank"
                    >
                        <i class="icon ion-md-download"></i>
                        Download
                    </a>
                </div>
            @endif @error('file') @include('components.inputs.partials.error')
            @enderror
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.text
                name="name"
                :value="old('name', ($editing ? $userUpload->name : ''))"
                label="{{ __('crud.user_uploads.inputs.name') }}"
                placeholder="{{ __('crud.user_uploads.inputs.name') }}"
                maxlength="255"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.textarea
                name="description"
                label="{{ __('crud.user_uploads.inputs.description') }}"
                placeholder="{{ __('crud.user_uploads.inputs.description') }}"
            >
                {{ old('description', ($editing ? $userUpload->description : '')) }}
            </x-inputs.textarea>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.text
                name="type"
                :value="old('type', ($editing ? $userUpload->type : ''))"
                label="{{ __('crud.user_uploads.inputs.type') }}"
                placeholder="{{ __('crud.user_uploads.inputs.type') }}"
                maxlength="255"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.textarea
                name="metadata"
                label="{{ __('crud.user_uploads.inputs.metadata') }}"
                placeholder="{{ __('crud.user_uploads.inputs.metadata') }}"
            >
                {{ old('metadata', ($editing ? json_encode($userUpload->metadata) : '')) }}
            </x-inputs.textarea>
        </x-inputs.group>
    </div>
</x-partials.card>
