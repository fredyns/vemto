<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.records.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}"
                                        autocomplete="off"
                                    ></x-inputs.text>

                                    <div class="ml-1">
                                        <button
                                            type="submit"
                                            class="button button-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\Record::class)
                                <a
                                    href="{{ route('records.create') }}"
                                    class="button button-primary"
                                >
                                    <i class="mr-1 icon ion-md-add"></i>
                                    @lang('crud.common.create')
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                        <tr>
                            <th class="px-4 py-3 text-left">
                                @lang('crud.records.inputs.user_id')
                            </th>
                            <th class="px-4 py-3 text-left">
                                @lang('crud.records.inputs.string')
                            </th>
                            <th class="px-4 py-3 text-left">
                                @lang('crud.records.inputs.email')
                            </th>
                            <th class="px-4 py-3 text-right">
                                @lang('crud.records.inputs.integer')
                            </th>
                            <th class="px-4 py-3 text-right">
                                @lang('crud.records.inputs.decimal')
                            </th>
                            <th class="px-4 py-3 text-left">
                                @lang('crud.records.inputs.n_p_w_p')
                            </th>
                            <th class="px-4 py-3 text-left">
                                @lang('crud.records.inputs.datetime')
                            </th>
                            <th class="px-4 py-3 text-left">
                                @lang('crud.records.inputs.date')
                            </th>
                            <th class="px-4 py-3 text-left">
                                @lang('crud.records.inputs.time')
                            </th>
                            <th class="px-4 py-3 text-left">
                                @lang('crud.records.inputs.i_p_address')
                            </th>
                            <th class="px-4 py-3 text-left">
                                @lang('crud.records.inputs.bool')
                            </th>
                            <th class="px-4 py-3 text-left">
                                @lang('crud.records.inputs.enum')
                            </th>
                            <th class="px-4 py-3 text-left">
                                @lang('crud.records.inputs.text')
                            </th>
                            <th class="px-4 py-3 text-left">
                                @lang('crud.records.inputs.file')
                            </th>
                            <th class="px-4 py-3 text-left">
                                @lang('crud.records.inputs.image')
                            </th>
                            <th class="px-4 py-3 text-left">
                                @lang('crud.records.inputs.markdown_text')
                            </th>
                            <th class="px-4 py-3 text-left">
                                @lang('crud.records.inputs.w_y_s_i_w_y_g')
                            </th>
                            <th class="px-4 py-3 text-left">
                                @lang('crud.records.inputs.j_s_o_n_list')
                            </th>
                            <th class="px-4 py-3 text-left">
                                @lang('crud.records.inputs.j_s_o_n_list')
                            </th>
                            <th class="px-4 py-3 text-left">
                                @lang('crud.records.inputs.j_s_o_n_list')
                            </th>
                            <th class="px-4 py-3 text-left">
                                @lang('crud.records.inputs.latitude')
                            </th>
                            <th class="px-4 py-3 text-left">
                                @lang('crud.records.inputs.longitude')
                            </th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600">
                        @forelse($records as $record)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ optional($record->user)->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $record->string ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $record->email ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $record->integer ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $record->decimal ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $record->n_p_w_p ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $record->datetime ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $record->date ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $record->time ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $record->i_p_address ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $record->bool ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $record->enum ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $record->text ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    @if($record->file)
                                        <a
                                            href="{{ Storage::url($record->file) }}"
                                            target="blank"
                                        ><i
                                                class="mr-1 icon ion-md-download"
                                            ></i
                                            >&nbsp;Download</a
                                        >
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <x-partials.thumbnail
                                        src="{{ $record->image ? Storage::url($record->image) : '' }}"
                                    />
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $record->markdown_text ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $record->w_y_s_i_w_y_g ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <pre>
{{ json_encode($record->j_s_o_n_list) ?? '-' }}</pre
                                    >
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <pre>
{{ json_encode($record->j_s_o_n_list) ?? '-' }}</pre
                                    >
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <pre>
{{ json_encode($record->j_s_o_n_list) ?? '-' }}</pre
                                    >
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $record->latitude ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $record->longitude ?? '-' }}
                                </td>
                                <td
                                    class="px-4 py-3 text-center"
                                    style="width: 134px;"
                                >
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="
                                            relative
                                            inline-flex
                                            align-middle
                                        "
                                    >
                                        @can('update', $record)
                                            <a
                                                href="{{ route('records.edit', $record) }}"
                                                class="mr-1"
                                            >
                                                <button
                                                    type="button"
                                                    class="button"
                                                >
                                                    <i
                                                        class="icon ion-md-create"
                                                    ></i>
                                                </button>
                                            </a>
                                        @endcan @can('view', $record)
                                            <a
                                                href="{{ route('records.show', $record) }}"
                                                class="mr-1"
                                            >
                                                <button
                                                    type="button"
                                                    class="button"
                                                >
                                                    <i class="icon ion-md-eye"></i>
                                                </button>
                                            </a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="23">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="23">
                                <div class="mt-10 px-4">
                                    {!! $records->render() !!}
                                </div>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
