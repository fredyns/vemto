<div>
    <div>
        @can('create', App\Models\Subrecord::class)
            <button class="button" wire:click="newSubrecord">
                <i class="mr-1 icon ion-md-add text-primary"></i>
                @lang('crud.common.new')
            </button>
        @endcan @can('delete-any', App\Models\Subrecord::class)
            <button
                class="button button-danger"
                {{ empty($selected) ? 'disabled' : '' }}
                onclick="confirm('{{ __('crud.common.are_you_sure') }}') || event.stopImmediatePropagation()"
                wire:click="destroySelected"
            >
                <i class="mr-1 icon ion-md-trash text-primary"></i>
                @lang('crud.common.delete_selected')
            </button>
        @endcan
    </div>

    <x-modal wire:model="showingModalView">
        <div class="px-6 py-4">
            <div class="text-lg font-bold">{{ $modalTitle }}</div>

            <div class="mt-5">
                <div class="flex flex-wrap">
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.subrecords.inputs.datetime')
                        </h5>
                        <span>
                            {{ optional($subrecord->datetime)->format('l, d F Y, H:i') }}
                        </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.subrecords.inputs.date')
                        </h5>
                        <span>
                            {{ optional($subrecord->date)->format('l, d F Y') }}
                        </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.subrecords.inputs.time')
                        </h5>
                        <span>
                            {{ optional($subrecord->time)->format('H:i') }}
                        </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.subrecords.inputs.n_p_w_p')
                        </h5>
                        <span> {{ $subrecord->n_p_w_p ?? '-' }} </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.subrecords.inputs.markdown_text')
                        </h5>
                        <span> {{ $subrecord->markdown_text ?? '-' }} </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.subrecords.inputs.w_y_s_i_w_y_g')
                        </h5>
                        <span> {{ $subrecord->w_y_s_i_w_y_g ?? '-' }} </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.subrecords.inputs.file')
                        </h5>
                        @if($subrecord->file)
                            <a
                                href="{{ Storage::url($subrecord->file) }}"
                                target="blank"
                            >
                                <i class="mr-1 icon ion-md-download"></i>
                                Download
                            </a>
                        @else
                            -
                        @endif
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.subrecords.inputs.image')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $subrecord->image ? Storage::url($subrecord->image) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.subrecords.inputs.i_p_address')
                        </h5>
                        <span> {{ $subrecord->i_p_address ?? '-' }} </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.subrecords.inputs.latitude')
                        </h5>
                        <span> {{ $subrecord->latitude ?? '-' }} </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.subrecords.inputs.longitude')
                        </h5>
                        <span> {{ $subrecord->longitude ?? '-' }} </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 flex justify-between">
            <button
                type="button"
                class="button"
                wire:click="$toggle('showingModalView')"
            >
                <i class="mr-1 icon ion-md-close"></i>
                @lang('text.close')
            </button>
            @can('update', $subrecord)
                <button
                    type="button"
                    class="button mr-1"
                    wire:click="editSubrecord('{{ $subrecord->id }}')"
                >
                    <i class="mr-1 icon ion-md-create"></i>
                    @lang('crud.common.edit')
                </button>
            @endcan
        </div>
    </x-modal>

    <x-modal wire:model="showingModalForm">
        <div class="px-6 py-4">
            <div class="text-lg font-bold">{{ $modalTitle }}</div>

            <div class="mt-5">
                <div class="flex flex-wrap">
                    <x-inputs.group class="w-full">
                        <x-inputs.datetime
                            name="subrecordDatetime"
                            wire:model="subrecordDatetime"
                            label="{{ __('crud.subrecords.inputs.datetime') }}"
                            placeholder="{{ __('crud.subrecords.inputs.datetime') }}"
                        ></x-inputs.datetime>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.date
                            name="subrecordDate"
                            wire:model="subrecordDate"
                            label="{{ __('crud.subrecords.inputs.date') }}"
                            placeholder="{{ __('crud.subrecords.inputs.date') }}"
                        ></x-inputs.date>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.time
                            name="subrecordTime"
                            wire:model="subrecordTime"
                            label="{{ __('crud.subrecords.inputs.time') }}"
                            placeholder="{{ __('crud.subrecords.inputs.time') }}"
                            maxlength="255"
                        ></x-inputs.time>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="subrecord.n_p_w_p"
                            wire:model="subrecord.n_p_w_p"
                            label="{{ __('crud.subrecords.inputs.n_p_w_p') }}"
                            placeholder="{{ __('crud.subrecords.inputs.n_p_w_p') }}"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.textarea
                            name="subrecord.markdown_text"
                            wire:model="subrecord.markdown_text"
                            label="{{ __('crud.subrecords.inputs.markdown_text') }}"
                            placeholder="{{ __('crud.subrecords.inputs.markdown_text') }}"
                        >
                            {{ old('markdown_text', ($editing ? $subrecord->markdown_text : '')) }}
                        </x-inputs.textarea>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.textarea
                            name="subrecord.w_y_s_i_w_y_g"
                            wire:model="subrecord.w_y_s_i_w_y_g"
                            label="{{ __('crud.subrecords.inputs.w_y_s_i_w_y_g') }}"
                            placeholder="{{ __('crud.subrecords.inputs.w_y_s_i_w_y_g') }}"
                        >
                            {{ old('w_y_s_i_w_y_g', ($editing ? $subrecord->w_y_s_i_w_y_g : '')) }}
                        </x-inputs.textarea>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.partials.label
                            name="subrecordFile"
                            label="{{ __('crud.subrecords.inputs.file') }}"
                        ></x-inputs.partials.label>
                        <br/>

                        <input
                            type="file"
                            name="subrecordFile"
                            id="subrecordFile{{ $uploadIteration }}"
                            wire:model="subrecordFile"
                            class="form-control-file"
                        />

                        @if($editing && $subrecord->file)
                            <div class="mt-2">
                                <a
                                    href="{{ Storage::url($subrecord->file) }}"
                                    target="_blank"
                                >
                                    <i class="icon ion-md-download"></i>
                                    Download
                                </a>
                            </div>
                        @endif @error('subrecordFile')
                        @include('components.inputs.partials.error') @enderror
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <div
                            image-url="{{ $editing && $subrecord->image ? Storage::url($subrecord->image) : '' }}"
                            x-data="imageViewer()"
                            @refresh.window="refreshUrl()"
                        >
                            <x-inputs.partials.label
                                name="subrecordImage"
                                label="{{ __('crud.subrecords.inputs.image') }}"
                            ></x-inputs.partials.label>
                            <br/>

                            <!-- Show the image -->
                            <template x-if="imageUrl">
                                <img
                                    :src="imageUrl"
                                    class="
                                        object-cover
                                        rounded
                                        border border-gray-200
                                    "
                                    style="width: 100px; height: 100px;"
                                />
                            </template>

                            <!-- Show the gray box when image is not available -->
                            <template x-if="!imageUrl">
                                <div
                                    class="
                                        border
                                        rounded
                                        border-gray-200
                                        bg-gray-100
                                    "
                                    style="width: 100px; height: 100px;"
                                ></div>
                            </template>

                            <div class="mt-2">
                                <input
                                    type="file"
                                    name="subrecordImage"
                                    id="subrecordImage{{ $uploadIteration }}"
                                    wire:model="subrecordImage"
                                    @change="fileChosen"
                                />
                            </div>

                            @error('subrecordImage')
                            @include('components.inputs.partials.error')
                            @enderror
                        </div>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="subrecord.i_p_address"
                            wire:model="subrecord.i_p_address"
                            label="{{ __('crud.subrecords.inputs.i_p_address') }}"
                            placeholder="{{ __('crud.subrecords.inputs.i_p_address') }}"
                            maxlength="255"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="subrecord.latitude"
                            wire:model="subrecord.latitude"
                            label="{{ __('crud.subrecords.inputs.latitude') }}"
                            placeholder="{{ __('crud.subrecords.inputs.latitude') }}"
                            maxlength="255"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="subrecord.longitude"
                            wire:model="subrecord.longitude"
                            label="{{ __('crud.subrecords.inputs.longitude') }}"
                            placeholder="{{ __('crud.subrecords.inputs.longitude') }}"
                            maxlength="255"
                        ></x-inputs.text>
                    </x-inputs.group>
                </div>
            </div>

            @include('livewire.record-subrecords-grid-sample')

        </div>

        <div class="px-6 py-4 bg-gray-50 flex justify-between">
            <button
                type="button"
                class="button"
                wire:click="$toggle('showingModalForm')"
            >
                <i class="mr-1 icon ion-md-close"></i>
                @lang('crud.common.cancel')
            </button>

            <button
                type="button"
                class="button button-primary"
                wire:click="save"
            >
                <i class="mr-1 icon ion-md-save"></i>
                @lang('crud.common.save')
            </button>
        </div>
    </x-modal>

    <div class="block w-full overflow-auto scrolling-touch mt-4">
        <table class="w-full max-w-full mb-4 bg-transparent">
            <thead class="text-gray-700">
            <tr>
                <th class="px-4 py-3 text-left w-1">
                    <input
                        type="checkbox"
                        wire:model="allSelected"
                        wire:click="toggleFullSelection"
                        title="{{ trans('crud.common.select_all') }}"
                    />
                </th>
                <th class="px-4 py-3 text-left">
                    @lang('crud.record_subrecords.inputs.datetime')
                </th>
                <th class="px-4 py-3 text-left">
                    @lang('crud.record_subrecords.inputs.n_p_w_p')
                </th>
                <th class="px-4 py-3 text-left">
                    @lang('crud.record_subrecords.inputs.i_p_address')
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody class="text-gray-600">
            @foreach ($subrecords as $subrecord)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 text-left">
                        <input
                            type="checkbox"
                            value="{{ $subrecord->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ optional($subrecord->datetime)->format('D, d M Y, H:i') }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $subrecord->n_p_w_p ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $subrecord->i_p_address ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            <button
                                type="button"
                                class="button mr-1"
                                wire:click="viewSubrecord('{{ $subrecord->id }}')"
                            >
                                <i class="icon ion-md-eye"></i>
                            </button>
                            @can('update', $subrecord)
                                <button
                                    type="button"
                                    class="button mr-1"
                                    wire:click="editSubrecord('{{ $subrecord->id }}')"
                                >
                                    <i class="icon ion-md-create"></i>
                                </button>
                            @endcan
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="4">
                    <div class="mt-10 px-4">
                        {{ $subrecords->render() }}
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
