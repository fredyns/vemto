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

    <x-modal wire:model="showingModal">
        <div class="px-6 py-4">
            <div class="text-lg font-bold">{{ $modalTitle }}</div>

            <div class="mt-5">
                <div class="flex flex-wrap">
                    <x-inputs.group class="w-full">
                        <x-inputs.datetime
                            name="subrecord.datetime"
                            label="Datetime"
                            wire:model="subrecord.datetime"
                            max="255"
                        ></x-inputs.datetime>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.date
                            name="subrecordDate"
                            label="{{ __('crud.subrecords.inputs.date') }}"
                            wire:model="subrecordDate"
                            max="255"
                        ></x-inputs.date>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="subrecord.time"
                            label="{{ __('crud.subrecords.inputs.time') }}"
                            wire:model="subrecord.time"
                            maxlength="255"
                            placeholder="{{ __('crud.subrecords.inputs.time') }}"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="subrecord.n_p_w_p"
                            label="{{ __('crud.subrecords.inputs.n_p_w_p') }}"
                            wire:model="subrecord.n_p_w_p"
                            maxlength="255"
                            placeholder="{{ __('crud.subrecords.inputs.n_p_w_p') }}"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.textarea
                            name="subrecord.markdown_text"
                            label="{{ __('crud.subrecords.inputs.markdown_text') }}"
                            wire:model="subrecord.markdown_text"
                        ></x-inputs.textarea>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.textarea
                            name="subrecord.w_y_s_i_w_y_g"
                            label="{{ __('crud.subrecords.inputs.w_y_s_i_w_y_g') }}"
                            wire:model="subrecord.w_y_s_i_w_y_g"
                            maxlength="255"
                        ></x-inputs.textarea>
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
                            label="{{ __('crud.subrecords.inputs.i_p_address') }}"
                            wire:model="subrecord.i_p_address"
                            maxlength="255"
                            placeholder="{{ __('crud.subrecords.inputs.i_p_address') }}"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-4/12">
                        <x-inputs.checkbox
                            name="subrecord.j_s_o_n_list"
                            label="{{ __('crud.subrecords.inputs.j_s_o_n_list') }}"
                            wire:model="subrecord.j_s_o_n_list"
                        ></x-inputs.checkbox>
                    </x-inputs.group>
                    <x-inputs.group class="w-full md:w-4/12">
                        <x-inputs.checkbox
                            name="subrecord.j_s_o_n_list"
                            label="{{ __('crud.subrecords.inputs.j_s_o_n_list') }}"
                            wire:model="subrecord.j_s_o_n_list"
                        ></x-inputs.checkbox>
                    </x-inputs.group>
                    <x-inputs.group class="w-full md:w-4/12">
                        <x-inputs.checkbox
                            name="subrecord.j_s_o_n_list"
                            label="{{ __('crud.subrecords.inputs.j_s_o_n_list') }}"
                            wire:model="subrecord.j_s_o_n_list"
                        ></x-inputs.checkbox>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="subrecord.latitude"
                            label="{{ __('crud.subrecords.inputs.latitude') }}"
                            wire:model="subrecord.latitude"
                            maxlength="255"
                            placeholder="{{ __('crud.subrecords.inputs.latitude') }}"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="subrecord.longitude"
                            label="{{ __('crud.subrecords.inputs.longitude') }}"
                            wire:model="subrecord.longitude"
                            maxlength="255"
                            placeholder="{{ __('crud.subrecords.inputs.longitude') }}"
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
                wire:click="$toggle('showingModal')"
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
                <th class="px-4 py-3 text-left">
                    @lang('crud.record_subrecords.inputs.j_s_o_n_list')
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
                        {{ $subrecord->datetime ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $subrecord->n_p_w_p ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $subrecord->i_p_address ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right">
                        <pre>
                                            {{ json_encode($subrecord->j_s_o_n_list) ?? '-' }}
                                        </pre
                                        >
                    </td>
                    <td class="px-4 py-3 text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $subrecord)
                                <button
                                    type="button"
                                    class="button"
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
                <td colspan="5">
                    <div class="mt-10 px-4">
                        {{ $subrecords->render() }}
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
