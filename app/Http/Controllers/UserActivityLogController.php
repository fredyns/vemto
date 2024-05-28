<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\UserActivityLog;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UserActivityLogStoreRequest;
use App\Http\Requests\UserActivityLogUpdateRequest;

class UserActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', UserActivityLog::class);

        $search = (string)$request->get('search', '');

        $userActivityLogs = UserActivityLog::search($search)
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view(
            'app.user_activity_logs.index',
            compact('userActivityLogs', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', UserActivityLog::class);

        $users = User::pluck('name', 'id');

        return view('app.user_activity_logs.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        UserActivityLogStoreRequest $request
    ): RedirectResponse
    {
        $this->authorize('create', UserActivityLog::class);

        $validated = $request->validated();

        $userActivityLog = UserActivityLog::create($validated);

        return redirect()
            ->route('user-activity-logs.show', $userActivityLog)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request         $request,
        UserActivityLog $userActivityLog
    ): View
    {
        $this->authorize('view', $userActivityLog);

        return view('app.user_activity_logs.show', compact('userActivityLog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request         $request,
        UserActivityLog $userActivityLog
    ): View
    {
        $this->authorize('update', $userActivityLog);

        $users = User::pluck('name', 'id');

        return view(
            'app.user_activity_logs.edit',
            compact('userActivityLog', 'users')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UserActivityLogUpdateRequest $request,
        UserActivityLog              $userActivityLog
    ): RedirectResponse
    {
        $this->authorize('update', $userActivityLog);

        $validated = $request->validated();

        $userActivityLog->update($validated);

        return redirect()
            ->route('user-activity-logs.show', $userActivityLog)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request         $request,
        UserActivityLog $userActivityLog
    ): RedirectResponse
    {
        $this->authorize('delete', $userActivityLog);

        $userActivityLog->delete();

        return redirect()
            ->route('user-activity-logs.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
