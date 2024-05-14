<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Models\UserGallery;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserGalleryStoreRequest;
use App\Http\Requests\UserGalleryUpdateRequest;

class UserGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', UserGallery::class);

        $search = $request->get('search', '');

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
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public');
        }

        $validated['metadata'] = json_decode($validated['metadata'], true);

        $userGallery = UserGallery::create($validated);

        return redirect()
            ->route('user-galleries.edit', $userGallery)
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
        UserGallery $userGallery
    ): RedirectResponse {
        $this->authorize('update', $userGallery);

        $validated = $request->validated();
        if ($request->hasFile('file')) {
            if ($userGallery->file) {
                Storage::delete($userGallery->file);
            }

            $validated['file'] = $request->file('file')->store('public');
        }

        $validated['metadata'] = json_decode($validated['metadata'], true);

        $userGallery->update($validated);

        return redirect()
            ->route('user-galleries.edit', $userGallery)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        UserGallery $userGallery
    ): RedirectResponse {
        $this->authorize('delete', $userGallery);

        if ($userGallery->file) {
            Storage::delete($userGallery->file);
        }

        $userGallery->delete();

        return redirect()
            ->route('user-galleries.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
