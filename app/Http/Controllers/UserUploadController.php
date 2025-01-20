<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUploadStoreRequest;
use App\Http\Requests\UserUploadUpdateRequest;
use App\Models\User;
use App\Models\UserUpload;
use fredyns\stringcleaner\StringCleaner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', UserUpload::class);

        $search = (string)$request->get('search', '');

        if (!$search or $search == 'null') {
            $search = '';
        }

        $userUploads = UserUpload::search($search)
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('app.user_uploads.index', compact('userUploads', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', UserUpload::class);

        $users = User::pluck('name', 'id');

        return view('app.user_uploads.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserUploadStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', UserUpload::class);

        $validated = $request->validated();
        $validated['metadata'] = json_decode($validated['metadata'], true);
        $validated['description'] = StringCleaner::forRTF(
            $validated['description']
        );

        $uploadPath = 'public/user-uploads/' . date('Y/m/d');
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store($uploadPath);
        }

        $userUpload = UserUpload::create($validated);

        return redirect()
            ->route('user-uploads.show', $userUpload)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, UserUpload $userUpload): View
    {
        $this->authorize('view', $userUpload);

        return view('app.user_uploads.show', compact('userUpload'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, UserUpload $userUpload): View
    {
        $this->authorize('update', $userUpload);

        $users = User::pluck('name', 'id');

        return view('app.user_uploads.edit', compact('userUpload', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UserUploadUpdateRequest $request,
        UserUpload              $userUpload
    ): RedirectResponse
    {
        $this->authorize('update', $userUpload);

        $validated = $request->validated();
        $validated['metadata'] = json_decode($validated['metadata'], true);
        $validated['description'] = StringCleaner::forRTF(
            $validated['description']
        );

        $uploadPath = 'public/user-uploads/' . date('Y/m/d');
        if ($request->hasFile('file')) {
            if ($userUpload->file) {
                Storage::delete($userUpload->file);
            }

            $validated['file'] = $request->file('file')->store($uploadPath);
        }

        $userUpload->update($validated);

        return redirect()
            ->route('user-uploads.show', $userUpload)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request    $request,
        UserUpload $userUpload
    ): RedirectResponse
    {
        $this->authorize('delete', $userUpload);

        if ($userUpload->file) {
            Storage::delete($userUpload->file);
        }

        $userUpload->delete();

        return redirect()
            ->route('user-uploads.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
