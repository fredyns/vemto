<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.user_uploads.create_title')
        </h2>
    </x-slot>

    <x-form
        method="POST"
        action="{{ route('user-uploads.store') }}"
        has-files
        class="mt-4"
    >
        @include('app.user_uploads.form-inputs')

        <div class="mt-10">
            <a href="{{ route('user-uploads.index') }}" class="button">
                <i class="mr-1 icon ion-md-return-left text-primary"></i>
                @lang('crud.common.back')
            </a>

            <button type="submit" class="button button-primary float-right">
                <i class="mr-1 icon ion-md-save"></i>
                @lang('crud.common.create')
            </button>
        </div>
    </x-form>
</x-app-layout>
