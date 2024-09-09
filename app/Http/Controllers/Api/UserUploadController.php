<?php

namespace App\Http\Controllers\Api;

use App\Models\UserUpload;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\UserUploadResource;
use App\Http\Resources\UserUploadCollection;
use App\Http\Requests\UserUploadStoreRequest;
use App\Http\Requests\UserUploadUpdateRequest;

class UserUploadController extends Controller
{
    public function index(Request $request): UserUploadCollection
    {
        $this->authorize('view-any', UserUpload::class);

        $search = (string)$request->get('search', '');

        if (!$search or $search == 'null') $search = '';

        $userUploads = UserUpload::search($search)
            ->latest('id')
            ->paginate(10);

        return new UserUploadCollection($userUploads);
    }

    public function store(UserUploadStoreRequest $request): UserUploadResource
    {
        $this->authorize('create', UserUpload::class);

        $validated = $request->validated();
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public');
        }

        $validated['metadata'] = json_decode($validated['metadata'], true);

        $userUpload = UserUpload::create($validated);

        return new UserUploadResource($userUpload);
    }

    public function show(
        Request    $request,
        UserUpload $userUpload
    ): UserUploadResource
    {
        $this->authorize('view', $userUpload);

        return new UserUploadResource($userUpload);
    }

    public function update(
        UserUploadUpdateRequest $request,
        UserUpload              $userUpload
    ): UserUploadResource
    {
        $this->authorize('update', $userUpload);

        $validated = $request->validated();

        if ($request->hasFile('file')) {
            if ($userUpload->file) {
                Storage::delete($userUpload->file);
            }

            $validated['file'] = $request->file('file')->store('public');
        }

        $validated['metadata'] = json_decode($validated['metadata'], true);

        $userUpload->update($validated);

        return new UserUploadResource($userUpload);
    }

    public function destroy(Request $request, UserUpload $userUpload): Response
    {
        $this->authorize('delete', $userUpload);

        if ($userUpload->file) {
            Storage::delete($userUpload->file);
        }

        $userUpload->delete();

        return response()->noContent();
    }
}
