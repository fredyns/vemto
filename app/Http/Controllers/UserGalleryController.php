<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserGalleryStoreRequest;
use App\Http\Requests\UserGalleryUpdateRequest;
use App\Models\User;
use App\Models\UserGallery;
use fredyns\stringcleaner\StringCleaner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', UserGallery::class);

        $search = (string)$request->get('search', '');

        if (!$search or $search == 'null') {
            $search = '';
        }

        $userGalleries = UserGallery::search($search)
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view(
            'app.user_galleries.index',
            compact('userGalleries', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', UserGallery::class);

        $users = User::pluck('name', 'id');

        return view('app.user_galleries.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserGalleryStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', UserGallery::class);

        $validated = $request->validated();
        $validated['metadata'] = json_decode($validated['metadata'], true);
        $validated['description'] = StringCleaner::forRTF(
            $validated['description']
        );

        $uploadPath = 'public/user-galleries/' . date('Y/m/d');
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store($uploadPath);
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store($uploadPath);
        }

        $userGallery = UserGallery::create($validated);

        return redirect()
            ->route('user-galleries.show', $userGallery)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, UserGallery $userGallery): View
    {
        $this->authorize('view', $userGallery);

        return view('app.user_galleries.show', compact('userGallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, UserGallery $userGallery): View
    {
        $this->authorize('update', $userGallery);

        $users = User::pluck('name', 'id');

        return view('app.user_galleries.edit', compact('userGallery', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UserGalleryUpdateRequest $request,
        UserGallery              $userGallery
    ): RedirectResponse
    {
        $this->authorize('update', $userGallery);

        $validated = $request->validated();
        $validated['metadata'] = json_decode($validated['metadata'], true);
        $validated['description'] = StringCleaner::forRTF(
            $validated['description']
        );

        $uploadPath = 'public/user-galleries/' . date('Y/m/d');
        if ($request->hasFile('file')) {
            if ($userGallery->file) {
                Storage::delete($userGallery->file);
            }

            $validated['file'] = $request->file('file')->store($uploadPath);
        }

        if ($request->hasFile('thumbnail')) {
            if ($userGallery->thumbnail) {
                Storage::delete($userGallery->thumbnail);
            }

            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store($uploadPath);
        }

        $userGallery->update($validated);

        return redirect()
            ->route('user-galleries.show', $userGallery)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request     $request,
        UserGallery $userGallery
    ): RedirectResponse
    {
        $this->authorize('delete', $userGallery);

        if ($userGallery->file) {
            Storage::delete($userGallery->file);
        }

        if ($userGallery->thumbnail) {
            Storage::delete($userGallery->thumbnail);
        }

        $userGallery->delete();

        return redirect()
            ->route('user-galleries.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
