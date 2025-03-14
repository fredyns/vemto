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
                :value="old('string', ($editing ? $record->string : ''))"
                label="{{ __('crud.records.inputs.string') }}"
                placeholder="{{ __('crud.records.inputs.string') }}"
                maxlength="255"
                required
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.email
                name="email"
                :value="old('email', ($editing ? $record->email : ''))"
                label="{{ __('crud.records.inputs.email') }}"
                placeholder="{{ __('crud.records.inputs.email') }}"
                maxlength="255"
            ></x-inputs.email>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.slider
                name="integer"
                :value="old('integer', ($editing ? $record->integer : ''))"
                label="{{ __('crud.records.inputs.integer') }}"
                placeholder="{{ __('crud.records.inputs.integer') }}"
                min="0"
                max="100"
            ></x-inputs.slider>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.slider
                name="decimal"
                :value="old('decimal', ($editing ? $record->decimal : ''))"
                label="{{ __('crud.records.inputs.decimal') }}"
                placeholder="{{ __('crud.records.inputs.decimal') }}"
                max="255"
                step="0.01"
            ></x-inputs.slider>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.npwp
                name="n_p_w_p"
                value="{{ old('n_p_w_p', ($editing ? \Snippet\Helpers\NPWP::format($record->n_p_w_p) : '')) }}"
                label="{{ __('crud.records.inputs.n_p_w_p') }}"
            ></x-inputs.npwp>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.datetime
                name="datetime"
                value="{{ old('datetime', ($editing ? optional($record->datetime)->format('Y-m-d H:i:s') : '')) }}"
                label="{{ __('crud.records.inputs.datetime') }}"
                placeholder="{{ __('crud.records.inputs.datetime') }}"
            ></x-inputs.datetime>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.date
                name="date"
                value="{{ old('date', ($editing ? optional($record->date)->format('Y-m-d') : '')) }}"
                label="{{ __('crud.records.inputs.date') }}"
                placeholder="{{ __('crud.records.inputs.date') }}"
            ></x-inputs.date>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.time
                name="time"
                value="{{ old('time', ($editing ? optional($record->time)->format('H:i') : '')) }}"
                label="{{ __('crud.records.inputs.time') }}"
                placeholder="{{ __('crud.records.inputs.time') }}"
            ></x-inputs.time>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.text
                name="i_p_address"
                x-data
                x-mask="999.999.999.999"
                :value="old('i_p_address', ($editing ? $record->i_p_address : ''))"
                label="{{ __('crud.records.inputs.i_p_address') }}"
                placeholder="000.000.000.000"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.toggle
                name="boolean"
                :value="old('boolean', ($editing ? $record->boolean : 0))"
                label="{{ __('crud.records.inputs.boolean') }}"
            ></x-inputs.toggle>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.select
                name="enumerate"
                label="{{ __('crud.records.inputs.enumerate') }}"
            >
                @php $selected = old('enumerate', ($editing ? $record->enumerate : '')) @endphp
                <option value="enabled" {{ $selected == 'enabled' ? 'selected' : '' }} >Enabled</option>
                <option value="disabled" {{ $selected == 'disabled' ? 'selected' : '' }} >Disabled</option>
            </x-inputs.select>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.textarea
                name="text"
                label="{{ __('crud.records.inputs.text') }}"
                placeholder="{{ __('crud.records.inputs.text') }}"
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
            <x-inputs.trix
                name="markdown_text"
                label="{{ __('crud.records.inputs.markdown_text') }}"
                value="{{ old('markdown_text', ($editing ? $record->markdown_text : '')) }}"
            ></x-inputs.trix>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.trix
                name="w_y_s_i_w_y_g"
                label="{{ __('crud.records.inputs.w_y_s_i_w_y_g') }}"
                value="{{ old('w_y_s_i_w_y_g', ($editing ? $record->w_y_s_i_w_y_g : '')) }}"
            ></x-inputs.trix>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.text
                name="latitude"
                :value="old('latitude', ($editing ? $record->latitude : ''))"
                label="{{ __('crud.records.inputs.latitude') }}"
                placeholder="{{ __('crud.records.inputs.latitude') }}"
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.text
                name="longitude"
                :value="old('longitude', ($editing ? $record->longitude : ''))"
                label="{{ __('crud.records.inputs.longitude') }}"
                placeholder="{{ __('crud.records.inputs.longitude') }}"
            ></x-inputs.text>
        </x-inputs.group>
    </div>
</x-partials.card>
