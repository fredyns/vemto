<?php

namespace App\Http\Controllers\Api;

use App\Models\UserGallery;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\UserGalleryResource;
use App\Http\Resources\UserGalleryCollection;
use App\Http\Requests\UserGalleryStoreRequest;
use App\Http\Requests\UserGalleryUpdateRequest;

class UserGalleryController extends Controller
{
    public function index(Request $request): UserGalleryCollection
    {
        $this->authorize('view-any', UserGallery::class);

        $search = (string)$request->get('search', '');

        $userGalleries = UserGallery::search($search)
            ->latest('id')
            ->paginate();

        return new UserGalleryCollection($userGalleries);
    }

    public function store(UserGalleryStoreRequest $request): UserGalleryResource
    {
        $this->authorize('create', UserGallery::class);

        $validated = $request->validated();
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public');
        }

        $validated['metadata'] = json_decode($validated['metadata'], true);

        $userGallery = UserGallery::create($validated);

        return new UserGalleryResource($userGallery);
    }

    public function show(
        Request $request,
        UserGallery $userGallery
    ): UserGalleryResource {
        $this->authorize('view', $userGallery);

        return new UserGalleryResource($userGallery);
    }

    public function update(
        UserGalleryUpdateRequest $request,
        UserGallery $userGallery
    ): UserGalleryResource {
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

        return new UserGalleryResource($userGallery);
    }

    public function destroy(
        Request $request,
        UserGallery $userGallery
    ): Response {
        $this->authorize('delete', $userGallery);

        if ($userGallery->file) {
            Storage::delete($userGallery->file);
        }

        $userGallery->delete();

        return response()->noContent();
    }
}
