<?php

namespace App\Http\Controllers\Api;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecordResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\RecordCollection;
use App\Http\Requests\RecordStoreRequest;
use App\Http\Requests\RecordUpdateRequest;

class RecordController extends Controller
{
    public function index(Request $request): RecordCollection
    {
        $this->authorize('view-any', Record::class);

        $search = (string)$request->get('search', '');

        $records = Record::search($search)
            ->latest()
            ->paginate();

        return new RecordCollection($records);
    }

    public function store(RecordStoreRequest $request): RecordResource
    {
        $this->authorize('create', Record::class);

        $validated = $request->validated();
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public');
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $record = Record::create($validated);

        return new RecordResource($record);
    }

    public function show(Request $request, Record $record): RecordResource
    {
        $this->authorize('view', $record);

        return new RecordResource($record);
    }

    public function update(
        RecordUpdateRequest $request,
        Record $record
    ): RecordResource {
        $this->authorize('update', $record);

        $validated = $request->validated();

        if ($request->hasFile('file')) {
            if ($record->file) {
                Storage::delete($record->file);
            }

            $validated['file'] = $request->file('file')->store('public');
        }

        if ($request->hasFile('image')) {
            if ($record->image) {
                Storage::delete($record->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $validated['j_s_o_n_list'] = json_decode(
            $validated['j_s_o_n_list'],
            true
        );

        $validated['j_s_o_n_list'] = json_decode(
            $validated['j_s_o_n_list'],
            true
        );

        $validated['j_s_o_n_list'] = json_decode(
            $validated['j_s_o_n_list'],
            true
        );

        $record->update($validated);

        return new RecordResource($record);
    }

    public function destroy(Request $request, Record $record): Response
    {
        $this->authorize('delete', $record);

        if ($record->file) {
            Storage::delete($record->file);
        }

        if ($record->image) {
            Storage::delete($record->image);
        }

        $record->delete();

        return response()->noContent();
    }
}
