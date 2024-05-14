<?php

namespace App\Http\Controllers\Api;

use App\Models\Record;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubrecordResource;
use App\Http\Resources\SubrecordCollection;

class RecordSubrecordsController extends Controller
{
    public function index(Request $request, Record $record): SubrecordCollection
    {
        $this->authorize('view', $record);

        $search = $request->get('search', '');

        $subrecords = $record
            ->subrecords()
            ->search($search)
            ->latest()
            ->paginate();

        return new SubrecordCollection($subrecords);
    }

    public function store(Request $request, Record $record): SubrecordResource
    {
        $this->authorize('create', Subrecord::class);

        $validated = $request->validate([
            'datetime' => ['nullable', 'date'],
            'date' => ['nullable', 'date'],
            'time' => ['nullable', 'date_format:H:i'],
            'n_p_w_p' => ['nullable'],
            'markdown_text' => ['nullable', 'string'],
            'w_y_s_i_w_y_g' => ['nullable', 'string'],
            'file' => ['file', 'max:1024', 'nullable'],
            'image' => ['image', 'max:1024', 'nullable'],
            'i_p_address' => ['nullable', 'max:255'],
            'j_s_o_n_list' => ['nullable'],
            'j_s_o_n_list' => ['nullable'],
            'j_s_o_n_list' => ['nullable'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public');
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $subrecord = $record->subrecords()->create($validated);

        return new SubrecordResource($subrecord);
    }
}