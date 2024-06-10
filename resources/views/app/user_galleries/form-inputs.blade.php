@php $editing = isset($userGallery) @endphp

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
                label="{{ __('crud.user_galleries.inputs.user_id') }}"
                required
            >
                @php $selected = old('user_id', ($editing ? $userGallery->user_id : '')) @endphp
                <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
                @foreach($users as $value => $label)
                    <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
                @endforeach
            </x-inputs.tomselect>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.datetime
                name="at"
                value="{{ old('at', ($editing ? optional($userGallery->at)->format('Y-m-d H:i:s') : '')) }}"
                label="{{ __('crud.user_galleries.inputs.at') }}"
                placeholder="{{ __('crud.user_galleries.inputs.at') }}"
                required
            ></x-inputs.datetime>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <div
                x-data="imageViewer('{{ $editing && $userGallery->file ? Storage::url($userGallery->file) : '' }}')"
            >
                <x-inputs.partials.label
                    name="file"
                    label="{{ __('crud.user_galleries.inputs.file') }}"
                ></x-inputs.partials.label>
                <br/>

                <!-- Show the image -->
                <template x-if="imageUrl">
                    <img
                        :src="imageUrl"
                        class="object-cover rounded border border-gray-200"
                        style="width: 100px; height: 100px;"
                    />
                </template>

                <!-- Show the gray box when image is not available -->
                <template x-if="!imageUrl">
                    <div
                        class="border rounded border-gray-200 bg-gray-100"
                        style="width: 100px; height: 100px;"
                    ></div>
                </template>

                <div class="mt-2">
                    <input
                        type="file"
                        name="file"
                        id="file"
                        @change="fileChosen"
                    />
                </div>

                @error('file') @include('components.inputs.partials.error')
                @enderror
            </div>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.text
                name="name"
                :value="old('name', ($editing ? $userGallery->name : ''))"
                label="{{ __('crud.user_galleries.inputs.name') }}"
                placeholder="{{ __('crud.user_galleries.inputs.name') }}"
                maxlength="255"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.textarea
                name="description"
                label="{{ __('crud.user_galleries.inputs.description') }}"
                placeholder="{{ __('crud.user_galleries.inputs.description') }}"
            >
                {{ old('description', ($editing ? $userGallery->description : '')) }}
            </x-inputs.textarea>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.text
                name="type"
                :value="old('type', ($editing ? $userGallery->type : ''))"
                label="{{ __('crud.user_galleries.inputs.type') }}"
                placeholder="{{ __('crud.user_galleries.inputs.type') }}"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.textarea
                name="metadata"
                label="{{ __('crud.user_galleries.inputs.metadata') }}"
                placeholder="{{ __('crud.user_galleries.inputs.metadata') }}"
            >
                {{ old('metadata', ($editing ? json_encode($userGallery->metadata) : '')) }}
            </x-inputs.textarea>
        </x-inputs.group>
    </div>
</x-partials.card>
