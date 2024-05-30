@php $editing = isset($record) @endphp

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
                label="{{ __('crud.records.inputs.user_id') }}"
            >
                @php $selected = old('user_id', ($editing ? $record->user_id : '')) @endphp
                <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
                @foreach($users as $value => $label)
                    <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
                @endforeach
            </x-inputs.tomselect>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.text
                name="string"
                label="{{ __('crud.records.inputs.string') }}"
                :value="old('string', ($editing ? $record->string : ''))"
                maxlength="255"
                placeholder="{{ __('crud.records.inputs.string') }}"
                required
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.email
                name="email"
                label="{{ __('crud.records.inputs.email') }}"
                :value="old('email', ($editing ? $record->email : ''))"
                maxlength="255"
                placeholder="{{ __('crud.records.inputs.email') }}"
            ></x-inputs.email>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.number
                name="integer"
                label="{{ __('crud.records.inputs.integer') }}"
                :value="old('integer', ($editing ? $record->integer : ''))"
                max="255"
                placeholder="{{ __('crud.records.inputs.integer') }}"
            ></x-inputs.number>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.number
                name="decimal"
                label="{{ __('crud.records.inputs.decimal') }}"
                :value="old('decimal', ($editing ? $record->decimal : ''))"
                max="255"
                step="0.01"
                placeholder="{{ __('crud.records.inputs.decimal') }}"
            ></x-inputs.number>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.text
                name="n_p_w_p"
                label="{{ __('crud.records.inputs.n_p_w_p') }}"
                :value="old('n_p_w_p', ($editing ? $record->n_p_w_p : ''))"
                placeholder="{{ __('crud.records.inputs.n_p_w_p') }}"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.datetime
                name="datetime"
                label="Datetime"
                value="{{ old('datetime', ($editing ? optional($record->datetime)->format('Y-m-d\TH:i:s') : '')) }}"
            ></x-inputs.datetime>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.date
                name="date"
                label="{{ __('crud.records.inputs.date') }}"
                value="{{ old('date', ($editing ? optional($record->date)->format('Y-m-d') : '')) }}"
            ></x-inputs.date>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.text
                name="time"
                label="{{ __('crud.records.inputs.time') }}"
                :value="old('time', ($editing ? $record->time : ''))"
                placeholder="{{ __('crud.records.inputs.time') }}"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.text
                name="i_p_address"
                label="{{ __('crud.records.inputs.i_p_address') }}"
                :value="old('i_p_address', ($editing ? $record->i_p_address : ''))"
                placeholder="{{ __('crud.records.inputs.i_p_address') }}"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.checkbox
                name="bool"
                label="{{ __('crud.records.inputs.bool') }}"
                :checked="old('bool', ($editing ? $record->bool : 0))"
            ></x-inputs.checkbox>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.select
                name="enum"
                label="{{ __('crud.records.inputs.enum') }}"
            >
                @php $selected = old('enum', ($editing ? $record->enum : '')) @endphp
                <option value="enabled" {{ $selected == 'enabled' ? 'selected' : '' }} >Enabled</option>
                <option value="disabled" {{ $selected == 'disabled' ? 'selected' : '' }} >Disabled</option>
            </x-inputs.select>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.textarea
                name="text"
                label="{{ __('crud.records.inputs.text') }}"
                maxlength="255"
            >
                {{ old('text', ($editing ? $record->text : '')) }}
            </x-inputs.textarea>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.partials.label
                name="file"
                label="{{ __('crud.records.inputs.file') }}"
            ></x-inputs.partials.label>
            <br/>

            <input
                type="file"
                name="file"
                id="file"
                class="form-control-file"
            />

            @if($editing && $record->file)
                <div class="mt-2">
                    <a href="{{ Storage::url($record->file) }}" target="_blank">
                        <i class="icon ion-md-download"></i>
                        Download
                    </a>
                </div>
            @endif @error('file') @include('components.inputs.partials.error')
            @enderror
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <div
                x-data="imageViewer('{{ $editing && $record->image ? Storage::url($record->image) : '' }}')"
            >
                <x-inputs.partials.label
                    name="image"
                    label="{{ __('crud.records.inputs.image') }}"
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
                        name="image"
                        id="image"
                        @change="fileChosen"
                    />
                </div>

                @error('image') @include('components.inputs.partials.error')
                @enderror
            </div>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.textarea
                name="markdown_text"
                label="{{ __('crud.records.inputs.markdown_text') }}"
            >
                {{ old('markdown_text', ($editing ? $record->markdown_text : '')) }}
            </x-inputs.textarea>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.textarea
                name="w_y_s_i_w_y_g"
                label="{{ __('crud.records.inputs.w_y_s_i_w_y_g') }}"
                maxlength="255"
            >
                {{ old('w_y_s_i_w_y_g', ($editing ? $record->w_y_s_i_w_y_g : '')) }}
            </x-inputs.textarea>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.checkbox
                name="j_s_o_n_list"
                label="{{ __('crud.records.inputs.j_s_o_n_list') }}"
                :checked="old('j_s_o_n_list', ($editing ? $record->j_s_o_n_list : 0))"
            ></x-inputs.checkbox>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.checkbox
                name="j_s_o_n_list"
                label="{{ __('crud.records.inputs.j_s_o_n_list') }}"
                :checked="old('j_s_o_n_list', ($editing ? $record->j_s_o_n_list : 0))"
            ></x-inputs.checkbox>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.checkbox
                name="j_s_o_n_list"
                label="{{ __('crud.records.inputs.j_s_o_n_list') }}"
                :checked="old('j_s_o_n_list', ($editing ? $record->j_s_o_n_list : 0))"
            ></x-inputs.checkbox>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.text
                name="latitude"
                label="{{ __('crud.records.inputs.latitude') }}"
                :value="old('latitude', ($editing ? $record->latitude : ''))"
                maxlength="255"
                placeholder="{{ __('crud.records.inputs.latitude') }}"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.text
                name="longitude"
                label="{{ __('crud.records.inputs.longitude') }}"
                :value="old('longitude', ($editing ? $record->longitude : ''))"
                maxlength="255"
                placeholder="{{ __('crud.records.inputs.longitude') }}"
            ></x-inputs.text>
        </x-inputs.group>
    </div>
</x-partials.card>

<div class="display: none;"></div>
<x-partials.card class="mt-5">
    <x-slot name="title">
        <span>Form Grid</span>
    </x-slot>

    <div class="flex flex-wrap">
        <x-inputs.group class="w-full md:w-6/12 lg:w-1/12">
            <x-inputs.text
                name="input1"
                label="Input 1"
                :value="old('string', ($editing ? $record->string : ''))"
                placeholder="input 1"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full md:w-6/12 lg:w-2/12">
            <x-inputs.text
                name="input2"
                label="Input 2"
                :value="old('string', ($editing ? $record->string : ''))"
                placeholder="input 2"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full md:w-4/12 lg:w-3/12">
            <x-inputs.text
                name="input3"
                label="Input 3"
                :value="old('string', ($editing ? $record->string : ''))"
                placeholder="input 3"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full md:w-4/12 lg:w-6/12">
            <x-inputs.text
                name="input4"
                label="Input 4"
                :value="old('string', ($editing ? $record->string : ''))"
                placeholder="input 4"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full md:w-4/12">
            <x-inputs.text
                name="input5"
                label="Input 5"
                :value="old('string', ($editing ? $record->string : ''))"
                placeholder="input 5"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full md:w-3/12 lg:w-4/12">
            <x-inputs.text
                name="input6"
                label="Input 6"
                :value="old('string', ($editing ? $record->string : ''))"
                placeholder="input 6"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full md:w-3/12 lg:w-4/12">
            <x-inputs.text
                name="input7"
                label="Input 7"
                :value="old('string', ($editing ? $record->string : ''))"
                placeholder="input 7"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full md:w-3/12">
            <x-inputs.text
                name="input8"
                label="Input 8"
                :value="old('string', ($editing ? $record->string : ''))"
                placeholder="input 8"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full md:w-3/12">
            <x-inputs.text
                name="input9"
                label="Input 9"
                :value="old('string', ($editing ? $record->string : ''))"
                placeholder="input 9"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full md:w-1/12 lg:w-3/12">
            <x-inputs.text
                name="input10"
                label="Input 10"
                :value="old('string', ($editing ? $record->string : ''))"
                placeholder="input 10"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full md:w-2/12 lg:w-3/12">
            <x-inputs.text
                name="input"
                label="Input 11"
                :value="old('string', ($editing ? $record->string : ''))"
                placeholder="input 11"
            ></x-inputs.text>
        </x-inputs.group>
    </div>
</x-partials.card>
