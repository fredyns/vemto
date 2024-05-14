<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.records.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('records.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.user_id')
                        </h5>
                        <span>{{ optional($record->user)->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.string')
                        </h5>
                        <span>{{ $record->string ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.email')
                        </h5>
                        <span>{{ $record->email ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.integer')
                        </h5>
                        <span>{{ $record->integer ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.decimal')
                        </h5>
                        <span>{{ $record->decimal ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.n_p_w_p')
                        </h5>
                        <span>{{ $record->n_p_w_p ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.datetime')
                        </h5>
                        <span>{{ $record->datetime ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.date')
                        </h5>
                        <span>{{ $record->date ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.time')
                        </h5>
                        <span>{{ $record->time ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.i_p_address')
                        </h5>
                        <span>{{ $record->i_p_address ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.bool')
                        </h5>
                        <span>{{ $record->bool ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.enum')
                        </h5>
                        <span>{{ $record->enum ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.text')
                        </h5>
                        <span>{{ $record->text ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.file')
                        </h5>
                        @if($record->file)
                        <a
                            href="{{ \Storage::url($record->file) }}"
                            target="blank"
                            ><i class="mr-1 icon ion-md-download"></i
                            >&nbsp;Download</a
                        >
                        @else - @endif
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.image')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $record->image ? \Storage::url($record->image) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.markdown_text')
                        </h5>
                        <span>{{ $record->markdown_text ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.w_y_s_i_w_y_g')
                        </h5>
                        <span>{{ $record->w_y_s_i_w_y_g ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.j_s_o_n_list')
                        </h5>
                        <pre>
{{ json_encode($record->j_s_o_n_list) ?? '-' }}</pre
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.j_s_o_n_list')
                        </h5>
                        <pre>
{{ json_encode($record->j_s_o_n_list) ?? '-' }}</pre
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.j_s_o_n_list')
                        </h5>
                        <pre>
{{ json_encode($record->j_s_o_n_list) ?? '-' }}</pre
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.latitude')
                        </h5>
                        <span>{{ $record->latitude ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.longitude')
                        </h5>
                        <span>{{ $record->longitude ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('records.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Record::class)
                    <a href="{{ route('records.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>

            @can('view-any', App\Models\Subrecord::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Subrecords </x-slot>

                <livewire:record-subrecords-detail :record="$record" />
            </x-partials.card>
            @endcan
        </div>
    </div>
</x-app-layout>
