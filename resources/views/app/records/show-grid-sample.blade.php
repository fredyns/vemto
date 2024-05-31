<x-partials.card class="mt-5">
    <x-slot name="title">
        <span>Field Grid</span>
    </x-slot>

    <div class="flex flex-wrap mt-4 px-4">
        <div class="mb-4 w-full md:w-6/12 lg:w-1/12">
            <h5 class="font-medium text-gray-700">
                M6/L1
            </h5>
            <span> {{ $record->string ?? '-' }} </span>
        </div>
        <div class="mb-4 w-full md:w-6/12 lg:w-2/12">
            <h5 class="font-medium text-gray-700">
                M6/L2
            </h5>
            <span> {{ $record->string ?? '-' }} </span>
        </div>
        <div class="mb-4 w-full md:w-4/12 lg:w-3/12">
            <h5 class="font-medium text-gray-700">
                M4/L3
            </h5>
            <span> {{ $record->string ?? '-' }} </span>
        </div>
        <div class="mb-4 w-full md:w-4/12 lg:w-6/12">
            <h5 class="font-medium text-gray-700">
                M4/L6
            </h5>
            <span> {{ $record->string ?? '-' }} </span>
        </div>
        <div class="mb-4 w-full md:w-4/12">
            <h5 class="font-medium text-gray-700">
                M4/L*
            </h5>
            <span> {{ $record->string ?? '-' }} </span>
        </div>
        <div class="mb-4 w-full md:w-3/12 lg:w-4/12">
            <h5 class="font-medium text-gray-700">
                M3/L4
            </h5>
            <span> {{ $record->string ?? '-' }} </span>
        </div>
        <div class="mb-4 w-full md:w-3/12 lg:w-4/12">
            <h5 class="font-medium text-gray-700">
                M3/L4
            </h5>
            <span> {{ $record->string ?? '-' }} </span>
        </div>
        <div class="mb-4 w-full md:w-3/12">
            <h5 class="font-medium text-gray-700">
                M3/L*
            </h5>
            <span> {{ $record->string ?? '-' }} </span>
        </div>
        <div class="mb-4 w-full md:w-3/12">
            <h5 class="font-medium text-gray-700">
                M3/L*
            </h5>
            <span> {{ $record->string ?? '-' }} </span>
        </div>
        <div class="mb-4 w-full md:w-1/12 lg:w-3/12">
            <h5 class="font-medium text-gray-700">
                M1/L3
            </h5>
            <span> {{ $record->string ?? '-' }} </span>
        </div>
        <div class="mb-4 w-full md:w-2/12 lg:w-3/12">
            <h5 class="font-medium text-gray-700">
                M2/L3
            </h5>
            <span> {{ $record->string ?? '-' }} </span>
        </div>
    </div>
</x-partials.card>
