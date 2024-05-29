<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="javascript: history.go(-1)" class="mr-4">
                <i class="mr-1 icon ion-md-arrow-back"></i>
            </a>
            @lang('crud.records.edit_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-form
                method="PUT"
                action="{{ route('records.update', $record) }}"
                has-files
            >

                @include('app.records.form-inputs')

                <div class="display: none;"></div>
                <x-partials.card class="mt-5">
                    <x-slot name="title">
                        <span>@lang('text.actions')</span>
                    </x-slot>
                    <div class="mt-4 px-4">
                        <a href="{{ route('records.index') }}" class="button">
                            <i class="mr-1 icon ion-md-return-left text-primary"></i>
                            @lang('crud.common.back')
                        </a>

                        <a
                            href="{{ route('records.show', $record) }}"
                            class="button"
                        >
                            <i class="mr-1 icon ion-md-backspace text-primary">
                            </i>
                            @lang('crud.common.cancel')
                        </a>

                        <button
                            type="submit"
                            class="button button-primary float-right"
                        >
                            <i class="mr-1 icon ion-md-save"></i>
                            @lang('crud.common.update')
                        </button>
                    </div>
                </x-partials.card>

            </x-form>

            @can('view-any', App\Models\Subrecord::class)
            <div class="display: none;"></div>
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
