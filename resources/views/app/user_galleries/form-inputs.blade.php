@php $editing = isset($userGallery) @endphp

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
                <x-inputs.select
                    name="user_id"
                    label="{{ __('crud.user_galleries.inputs.user_id') }}"
                    required
                >
                    @php $selected = old('user_id', ($editing ? $userGallery->user_id : '')) @endphp
                    <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
                    @foreach($users as $value => $label)
                    <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
                    @endforeach
                </x-inputs.select>
            </x-inputs.group>

            <x-inputs.group class="w-full">
                <x-inputs.date
                    name="at"
                    label="{{ __('crud.user_galleries.inputs.at') }}"
                    value="{{ old('at', ($editing ? optional($userGallery->at)->format('Y-m-d') : '')) }}"
                    max="255"
                    required
                ></x-inputs.date>
            </x-inputs.group>

            <x-inputs.group class="w-full">
                <div
                    x-data="imageViewer('{{ $editing && $userGallery->file ? \Storage::url($userGallery->file) : '' }}')"
                >
                    <x-inputs.partials.label
                        name="file"
                        label="{{ __('crud.user_galleries.inputs.file') }}"
                    ></x-inputs.partials.label>
                    <br />

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
                    label="{{ __('crud.user_galleries.inputs.name') }}"
                    :value="old('name', ($editing ? $userGallery->name : ''))"
                    maxlength="255"
                    placeholder="{{ __('crud.user_galleries.inputs.name') }}"
                ></x-inputs.text>
            </x-inputs.group>

            <x-inputs.group class="w-full">
                <x-inputs.textarea
                    name="description"
                    label="{{ __('crud.user_galleries.inputs.description') }}"
                    maxlength="255"
                    >{{ old('description', ($editing ? $userGallery->description
                    : '')) }}</x-inputs.textarea
                >
            </x-inputs.group>

            <x-inputs.group class="w-full">
                <x-inputs.text
                    name="type"
                    label="{{ __('crud.user_galleries.inputs.type') }}"
                    :value="old('type', ($editing ? $userGallery->type : ''))"
                    maxlength="255"
                    placeholder="{{ __('crud.user_galleries.inputs.type') }}"
                ></x-inputs.text>
            </x-inputs.group>

            <x-inputs.group class="w-full">
                <x-inputs.textarea
                    name="metadata"
                    label="{{ __('crud.user_galleries.inputs.metadata') }}"
                    maxlength="255"
                    >{{ old('metadata', ($editing ?
                    json_encode($userGallery->metadata) : ''))
                    }}</x-inputs.textarea
                >
            </x-inputs.group>

            <x-inputs.group class="w-full">
                <x-inputs.textarea
                    name="thumbnail"
                    label="{{ __('crud.user_galleries.inputs.thumbnail') }}"
                    maxlength="255"
                    >{{ old('thumbnail', ($editing ? $userGallery->thumbnail :
                    '')) }}</x-inputs.textarea
                >
            </x-inputs.group>
        </div>
    </x-partials.card>
</div>
