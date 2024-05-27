<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.users.show_title')
        </h2>
    </x-slot>

    <style>
        .trix-button--icon-link, .trix-button--icon-quote, .trix-button--icon-code, .trix-button--icon-attach {
            display: none;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('users.index') }}" class="mr-4">
                        <i class="mr-1 icon ion-md-arrow-back"></i>
                    </a>
                </x-slot>

                <div class="flex flex-wrap mt-4 px-4">
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.users.inputs.name')
                        </h5>
                        <span> {{ $user->name ?? '-' }} </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.users.inputs.email')
                        </h5>
                        <span> {{ $user->email ?? '-' }} </span>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('users.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('update', $user)
                    <a href="{{ route('users.edit', $user) }}" class="button">
                        <i class="mr-1 icon ion-md-create"></i>
                        @lang('crud.common.edit')
                    </a>
                    @endcan @can('delete', $user)
                    <div class="float-right">
                        <form
                            action="{{ route('users.destroy', $user) }}"
                            method="POST"
                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                        >
                            @csrf @method('DELETE')
                            <button type="submit" class="button">
                                <i
                                    class="mr-1 icon ion-md-trash text-red-600"
                                ></i>
                                <span class="text-red-600"
                                    >@lang('crud.common.delete')</span
                                >
                            </button>
                        </form>
                    </div>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
