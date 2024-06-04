<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="javascript: history.go(-1)" class="mr-4">
                <i class="mr-1 icon ion-md-arrow-back"></i>
            </a>
            @lang('crud.user_activity_logs.show_title')
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
                            @lang('crud.user_activity_logs.inputs.at')
                        </h5>
                        <span>
                            {{ optional($userActivityLog->at)->format('l, d F Y') }}
                        </span>
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
                        <a
                            class="underline cursor-pointer"
                            target="_blank"
                            href="{{ $userActivityLog->link }}"
                        >
                            {{ $userActivityLog->link ?? '-' }}
                        </a>
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
            </x-partials.card>

            <x-partials.card class="mt-5">
                <x-slot name="title">
                    <span>@lang('text.actions')</span>
                </x-slot>
                <div class="mt-4 px-4">
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
        </div>
    </div>
</x-app-layout>
