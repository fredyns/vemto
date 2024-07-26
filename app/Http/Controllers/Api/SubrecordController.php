<?php

namespace App\Http\Controllers\Api;

use App\Models\Subrecord;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\SubrecordResource;
use App\Http\Resources\SubrecordCollection;
use App\Http\Requests\SubrecordStoreRequest;
use App\Http\Requests\SubrecordUpdateRequest;

class SubrecordController extends Controller
{
    public function index(Request $request): SubrecordCollection
    {
        $this->authorize('view-any', Subrecord::class);

        $search = (string)$request->get('search', '');

        $subrecords = Subrecord::search($search)
            ->latest()
            ->paginate(10);

        return new SubrecordCollection($subrecords);
    }

    public function store(SubrecordStoreRequest $request): SubrecordResource
    {
        $this->authorize('create', Subrecord::class);

        $validated = $request->validated();
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public');
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $subrecord = Subrecord::create($validated);

        return new SubrecordResource($subrecord);
    }

    public function show(
        Request   $request,
        Subrecord $subrecord
    ): SubrecordResource
    {
        $this->authorize('view', $subrecord);

        return new SubrecordResource($subrecord);
    }

    public function update(
        SubrecordUpdateRequest $request,
        Subrecord              $subrecord
    ): SubrecordResource
    {
        $this->authorize('update', $subrecord);

        $validated = $request->validated();

        if ($request->hasFile('file')) {
            if ($subrecord->file) {
                Storage::delete($subrecord->file);
            }

            $validated['file'] = $request->file('file')->store('public');
        }

        if ($request->hasFile('image')) {
            if ($subrecord->image) {
                Storage::delete($subrecord->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $subrecord->update($validated);

        return new SubrecordResource($subrecord);
    }

    public function destroy(Request $request, Subrecord $subrecord): Response
    {
        $this->authorize('delete', $subrecord);

        if ($subrecord->file) {
            Storage::delete($subrecord->file);
        }

        if ($subrecord->image) {
            Storage::delete($subrecord->image);
        }

        $subrecord->delete();

        return response()->noContent();
    }
}
