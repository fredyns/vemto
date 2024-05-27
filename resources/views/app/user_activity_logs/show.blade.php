<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.user_activity_logs.show_title')
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
                    <a
                        href="{{ route('user-activity-logs.index') }}"
                        class="mr-4"
                    >
                        <i class="mr-1 icon ion-md-arrow-back"></i>
                    </a>
                </x-slot>

                <div class="flex flex-wrap mt-4 px-4">
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.user_activity_logs.inputs.at')
                        </h5>
                        <span> {{ $userActivityLog->at ?? '-' }} </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.user_activity_logs.inputs.user_id')
                        </h5>
                        <span>
                            {{ optional($userActivityLog->user)->name ?? '-' }}
                        </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.user_activity_logs.inputs.title')
                        </h5>
                        <span> {{ $userActivityLog->title ?? '-' }} </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.user_activity_logs.inputs.link')
                        </h5>
                        <span> {{ $userActivityLog->link ?? '-' }} </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.user_activity_logs.inputs.message')
                        </h5>
                        <span> {{ $userActivityLog->message ?? '-' }} </span>
                    </div>
                    <div class="mb-4 w-full">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.user_activity_logs.inputs.i_p_address')
                        </h5>
                        <span>
                            {{ $userActivityLog->i_p_address ?? '-' }}
                        </span>
                    </div>
                </div>

                <div class="mt-10">
                    <a
                        href="{{ route('user-activity-logs.index') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('update', $userActivityLog)
                    <a
                        href="{{ route('user-activity-logs.edit', $userActivityLog) }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-create"></i>
                        @lang('crud.common.edit')
                    </a>
                    @endcan @can('delete', $userActivityLog)
                    <div class="float-right">
                        <form
                            action="{{ route('user-activity-logs.destroy', $userActivityLog) }}"
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
