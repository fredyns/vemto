<?php

namespace App\Http\Controllers;

use App\Helpers\NPWP;
use App\Models\User;
use App\Models\Record;
use fredyns\stringcleaner\StringCleaner;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\RecordStoreRequest;
use App\Http\Requests\RecordUpdateRequest;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Record::class);

        $search = (string)$request->get('search', '');

        $records = Record::search($search)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('app.records.index', compact('records', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Record::class);

        $users = User::pluck('name', 'id');

        return view('app.records.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RecordStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Record::class);

        $validated = $request->validated();
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public', 'spaces');
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public', 'spaces');
        }

        $validated['markdown_text'] = StringCleaner::forRTF($validated['markdown_text']);
        $validated['w_y_s_i_w_y_g'] = StringCleaner::forRTF($validated['w_y_s_i_w_y_g']);
        $validated['n_p_w_p'] = NPWP::native($validated['n_p_w_p']);
        $record = Record::create($validated);

        return redirect()
            ->route('records.show', $record)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Record $record): View
    {
        $this->authorize('view', $record);

        return view('app.records.show', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Record $record): View
    {
        $this->authorize('update', $record);

        $users = User::pluck('name', 'id');

        return view('app.records.edit', compact('record', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        RecordUpdateRequest $request,
        Record              $record
    ): RedirectResponse
    {
        $this->authorize('update', $record);

        $validated = $request->validated();
        if ($request->hasFile('file')) {
            if ($record->file) {
                Storage::delete($record->file);
            }

            $validated['file'] = $request->file('file')->store('public', 'spaces');
        }

        if ($request->hasFile('image')) {
            if ($record->image) {
                Storage::delete($record->image);
            }

            $validated['image'] = $request->file('image')->store('public', 'spaces');
        }

        $validated['markdown_text'] = StringCleaner::forRTF($validated['markdown_text']);
        $validated['w_y_s_i_w_y_g'] = StringCleaner::forRTF($validated['w_y_s_i_w_y_g']);
        $validated['n_p_w_p'] = NPWP::native($validated['n_p_w_p']);
        $record->update($validated);

        return redirect()
            ->route('records.show', $record)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Record $record): RedirectResponse
    {
        $this->authorize('delete', $record);

        if ($record->file) {
            Storage::delete($record->file);
        }

        if ($record->image) {
            Storage::delete($record->image);
        }

        $record->delete();

        return redirect()
            ->route('records.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
