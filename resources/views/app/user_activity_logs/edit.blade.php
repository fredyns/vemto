<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.user_activity_logs.edit_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <x-form
            method="PUT"
            action="{{ route('user-activity-logs.update', $userActivityLog) }}"
            class="mt-4"
        >
            @include('app.user_activity_logs.form-inputs')

            <div class="max-w-7xl mx-auto py-3 sm:px-6 lg:px-8">
                <x-partials.card>
                    <div class="my-3">
                        <a
                            href="{{ route('user-activity-logs.index') }}"
                            class="button"
                        >
                            <i
                                class="
                                    mr-1
                                    icon
                                    ion-md-return-left
                                    text-primary
                                "
                            ></i>
                            @lang('crud.common.back')
                        </a>

                        <a
                            href="{{ route('user-activity-logs.show', $userActivityLog) }}"
                            class="button"
                        >
                            <i
                                class="mr-1 icon ion-md-backspace text-primary"
                            ></i>
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
            </div>
        </x-form>
    </div>
</x-app-layout>
