<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserActivityLogStoreRequest;
use App\Http\Requests\UserActivityLogUpdateRequest;
use App\Http\Resources\UserActivityLogCollection;
use App\Http\Resources\UserActivityLogResource;
use App\Models\UserActivityLog;
use fredyns\stringcleaner\StringCleaner;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserActivityLogController extends Controller
{
    public function index(Request $request): UserActivityLogCollection
    {
        $this->authorize('view-any', UserActivityLog::class);

        $search = (string)$request->get('search', '');

        if (!$search or $search == 'null') {
            $search = '';
        }

        $userActivityLogs = UserActivityLog::search($search)
            ->latest('id')
            ->paginate(10);

        return new UserActivityLogCollection($userActivityLogs);
    }

    public function store(
        UserActivityLogStoreRequest $request
    ): UserActivityLogResource
    {
        $this->authorize('create', UserActivityLog::class);

        $validated = $request->validated();
        $validated['message'] = StringCleaner::forRTF($validated['message']);

        $userActivityLog = UserActivityLog::create($validated);

        return new UserActivityLogResource($userActivityLog);
    }

    public function show(
        Request         $request,
        UserActivityLog $userActivityLog
    ): UserActivityLogResource
    {
        $this->authorize('view', $userActivityLog);

        return new UserActivityLogResource($userActivityLog);
    }

    public function update(
        UserActivityLogUpdateRequest $request,
        UserActivityLog              $userActivityLog
    ): UserActivityLogResource
    {
        $this->authorize('update', $userActivityLog);

        $validated = $request->validated();
        $validated['message'] = StringCleaner::forRTF($validated['message']);

        $userActivityLog->update($validated);

        return new UserActivityLogResource($userActivityLog);
    }

    public function destroy(
        Request         $request,
        UserActivityLog $userActivityLog
    ): Response
    {
        $this->authorize('delete', $userActivityLog);

        $userActivityLog->delete();

        return response()->noContent();
    }
}
