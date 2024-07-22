<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="javascript: history.go(-1)" class="mr-4">
                <i class="mr-1 icon ion-md-arrow-back"></i>
            </a>
            @lang('crud.records.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                {{--
                <x-slot name="title">
                    <span>@lang('card.title')</span>
                </x-slot>
                --}}

                <div class="flex flex-wrap mt-2 px-4">
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.user_id')
                        </h5>
                        <span>
                            {{ optional($record->user)->name ?? '-' }}
                        </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.string')
                        </h5>
                        <span> {{ $record->string ?? '-' }} </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.email')
                        </h5>
                        <span> {{ $record->email ?? '-' }} </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.integer')
                        </h5>
                        <span> {{ $record->integer ?? '-' }} </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.decimal')
                        </h5>
                        <span> {{ $record->decimal ?? '-' }} </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.n_p_w_p')
                        </h5>
                        <span> {{ $record->n_p_w_p ? \App\Helpers\NPWP::format($record->n_p_w_p) : '-' }} </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.datetime')
                        </h5>
                        <span>
                            {{ optional($record->datetime)->format('D, d M Y, H:i') }}
                        </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.date')
                        </h5>
                        <span>
                            {{ optional($record->date)->format('l, d F Y') }}
                        </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.time')
                        </h5>
                        <span>
                            {{ optional($record->time)->format('H:i') }}
                        </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.i_p_address')
                        </h5>
                        <span> {{ $record->i_p_address ?? '-' }} </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.boolean')
                        </h5>
                        <span> {{ $record->boolean ?? '-' }} </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.enumerate')
                        </h5>
                        <span> {{ $record->enumerate ?? '-' }} </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.text')
                        </h5>
                        <span> {{ $record->text ?? '-' }} </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.file')
                        </h5>
                        @if($record->file)
                            <a
                                href="{{ Storage::url($record->file) }}"
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
                            @lang('crud.records.inputs.image')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $record->image ? Storage::url($record->image) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.markdown_text')
                        </h5>
                        <span> {{ $record->markdown_text ?? '-' }} </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.w_y_s_i_w_y_g')
                        </h5>
                        <span> {!! $record->w_y_s_i_w_y_g ?? '-' !!} </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.latitude')
                        </h5>
                        <span> {{ $record->latitude ?? '-' }} </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.records.inputs.longitude')
                        </h5>
                        <span> {{ $record->longitude ?? '-' }} </span>
                    </div>
                </div>
            </x-partials.card>

            @include('app.records.show-grid-sample')

            <x-partials.card class="mt-5">
                <x-slot name="title">
                    <span>@lang('text.actions')</span>
                </x-slot>
                <div class="mt-4 px-4">
                    <a href="{{ route('records.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('update', $record)
                        <a
                            href="{{ route('records.edit', $record) }}"
                            class="button"
                        >
                            <i class="mr-1 icon ion-md-create"></i>
                            @lang('crud.common.edit')
                        </a>
                    @endcan @can('delete', $record)
                        <div class="float-right">
                            <form
                                action="{{ route('records.destroy', $record) }}"
                                method="POST"
                                onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                            >
                                @csrf @method('DELETE')
                                <button type="submit" class="button">
                                    <i class="mr-1 icon ion-md-trash text-red-600">
                                    </i>
                                    <span class="text-red-600">
                                    @lang('crud.common.delete')
                                </span>
                                </button>
                            </form>
                        </div>
                    @endcan
                </div>
            </x-partials.card>

            @can('view-any', App\Models\Subrecord::class)
                <x-partials.card class="mt-5">
                    <x-slot name="title">
                        @lang('crud.record_subrecords.name')
                    </x-slot>

                    <livewire:record-subrecords-detail :record="$record"/>
                </x-partials.card>
            @endcan
        </div>
    </div>
</x-app-layout>
