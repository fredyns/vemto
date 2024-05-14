@php $editing = isset($record) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User">
            @php $selected = old('user_id', ($editing ? $record->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="string"
            label="String"
            :value="old('string', ($editing ? $record->string : ''))"
            maxlength="255"
            placeholder="String"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.email
            name="email"
            label="Email"
            :value="old('email', ($editing ? $record->email : ''))"
            maxlength="255"
            placeholder="Email"
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="integer"
            label="Integer"
            :value="old('integer', ($editing ? $record->integer : ''))"
            max="255"
            placeholder="Integer"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="decimal"
            label="Decimal"
            :value="old('decimal', ($editing ? $record->decimal : ''))"
            max="255"
            step="0.01"
            placeholder="Decimal"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="n_p_w_p"
            label="N P W P"
            :value="old('n_p_w_p', ($editing ? $record->n_p_w_p : ''))"
            maxlength="255"
            placeholder="N P W P"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.datetime
            name="datetime"
            label="Datetime"
            value="{{ old('datetime', ($editing ? optional($record->datetime)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($record->date)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="time"
            label="Time"
            :value="old('time', ($editing ? $record->time : ''))"
            maxlength="255"
            placeholder="Time"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="i_p_address"
            label="I P Address"
            :value="old('i_p_address', ($editing ? $record->i_p_address : ''))"
            maxlength="255"
            placeholder="I P Address"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="bool"
            label="Bool"
            :checked="old('bool', ($editing ? $record->bool : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="enum" label="Enum">
            @php $selected = old('enum', ($editing ? $record->enum : '')) @endphp
            <option value="enabled" {{ $selected == 'enabled' ? 'selected' : '' }} >Enabled</option>
            <option value="disabled" {{ $selected == 'disabled' ? 'selected' : '' }} >Disabled</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="text" label="Text" maxlength="255"
            >{{ old('text', ($editing ? $record->text : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.partials.label
            name="file"
            label="File"
        ></x-inputs.partials.label
        ><br />

        <input type="file" name="file" id="file" class="form-control-file" />

        @if($editing && $record->file)
        <div class="mt-2">
            <a href="{{ \Storage::url($record->file) }}" target="_blank"
                ><i class="icon ion-md-download"></i>&nbsp;Download</a
            >
        </div>
        @endif @error('file') @include('components.inputs.partials.error')
        @enderror
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $record->image ? \Storage::url($record->image) : '' }}')"
        >
            <x-inputs.partials.label
                name="image"
                label="Image"
            ></x-inputs.partials.label
            ><br />

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
        <x-inputs.textarea name="markdown_text" label="Markdown Text"
            >{{ old('markdown_text', ($editing ? $record->markdown_text : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="w_y_s_i_w_y_g"
            label="W Y S I W Y G"
            maxlength="255"
            >{{ old('w_y_s_i_w_y_g', ($editing ? $record->w_y_s_i_w_y_g : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="j_s_o_n_list"
            label="J S O N List"
            :checked="old('j_s_o_n_list', ($editing ? $record->j_s_o_n_list : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="j_s_o_n_list"
            label="J S O N List"
            :checked="old('j_s_o_n_list', ($editing ? $record->j_s_o_n_list : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="j_s_o_n_list"
            label="J S O N List"
            :checked="old('j_s_o_n_list', ($editing ? $record->j_s_o_n_list : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="latitude"
            label="Latitude"
            :value="old('latitude', ($editing ? $record->latitude : ''))"
            maxlength="255"
            placeholder="Latitude"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="longitude"
            label="Longitude"
            :value="old('longitude', ($editing ? $record->longitude : ''))"
            maxlength="255"
            placeholder="Longitude"
        ></x-inputs.text>
    </x-inputs.group>
</div>
