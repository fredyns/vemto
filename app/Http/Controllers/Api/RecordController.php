<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecordStoreRequest;
use App\Http\Requests\RecordUpdateRequest;
use App\Http\Resources\RecordCollection;
use App\Http\Resources\RecordResource;
use App\Models\Record;
use fredyns\stringcleaner\StringCleaner;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class RecordController extends Controller
{
    public function index(Request $request): RecordCollection
    {
        $this->authorize('view-any', Record::class);

        $search = (string)$request->get('search', '');

        if (!$search or $search == 'null') {
            $search = '';
        }

        $records = Record::search($search)
            ->latest()
            ->paginate(10);

        return new RecordCollection($records);
    }

    public function store(RecordStoreRequest $request): RecordResource
    {
        $this->authorize('create', Record::class);

        $validated = $request->validated();
        $validated['text'] = StringCleaner::forRTF($validated['text']);
        $validated['markdown_text'] = StringCleaner::forRTF(
            $validated['markdown_text']
        );
        $validated['w_y_s_i_w_y_g'] = StringCleaner::forRTF(
            $validated['w_y_s_i_w_y_g']
        );

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
        Record              $record
    ): RecordResource
    {
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

        $validated['text'] = StringCleaner::forRTF($validated['text']);
        $validated['markdown_text'] = StringCleaner::forRTF(
            $validated['markdown_text']
        );
        $validated['w_y_s_i_w_y_g'] = StringCleaner::forRTF(
            $validated['w_y_s_i_w_y_g']
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
