<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserGalleryStoreRequest;
use App\Http\Requests\UserGalleryUpdateRequest;
use App\Http\Resources\UserGalleryCollection;
use App\Http\Resources\UserGalleryResource;
use App\Models\UserGallery;
use fredyns\stringcleaner\StringCleaner;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class UserGalleryController extends Controller
{
    public function index(Request $request): UserGalleryCollection
    {
        $this->authorize('view-any', UserGallery::class);

        $search = (string)$request->get('search', '');

        if (!$search or $search == 'null') {
            $search = '';
        }

        $userGalleries = UserGallery::search($search)
            ->latest('id')
            ->paginate(10);

        return new UserGalleryCollection($userGalleries);
    }

    public function store(UserGalleryStoreRequest $request): UserGalleryResource
    {
        $this->authorize('create', UserGallery::class);

        $validated = $request->validated();
        $validated['metadata'] = json_decode($validated['metadata'], true);
        $validated['description'] = StringCleaner::forRTF(
            $validated['description']
        );

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public');
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('public');
        }


        $userGallery = UserGallery::create($validated);

        return new UserGalleryResource($userGallery);
    }

    public function show(
        Request     $request,
        UserGallery $userGallery
    ): UserGalleryResource
    {
        $this->authorize('view', $userGallery);

        return new UserGalleryResource($userGallery);
    }

    public function update(
        UserGalleryUpdateRequest $request,
        UserGallery              $userGallery
    ): UserGalleryResource
    {
        $this->authorize('update', $userGallery);

        $validated = $request->validated();
        $validated['metadata'] = json_decode($validated['metadata'], true);
        $validated['description'] = StringCleaner::forRTF(
            $validated['description']
        );


        if ($request->hasFile('file')) {
            if ($userGallery->file) {
                Storage::delete($userGallery->file);
            }

            $validated['file'] = $request->file('file')->store('public');
        }

        if ($request->hasFile('thumbnail')) {
            if ($userGallery->thumbnail) {
                Storage::delete($userGallery->thumbnail);
            }

            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('public');
        }

        $userGallery->update($validated);

        return new UserGalleryResource($userGallery);
    }

    public function destroy(
        Request     $request,
        UserGallery $userGallery
    ): Response
    {
        $this->authorize('delete', $userGallery);

        if ($userGallery->file) {
            Storage::delete($userGallery->file);
        }

        if ($userGallery->thumbnail) {
            Storage::delete($userGallery->thumbnail);
        }

        $userGallery->delete();

        return response()->noContent();
    }
}
