<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use App\Support\MediaStorage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TeamMemberController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('admin/Team/Index', [
            'members' => TeamMember::query()->orderBy('sort_order')->orderBy('name')->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('admin/Team/Form', ['member' => null]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        if ($request->hasFile('image')) {
            $data['image'] = MediaStorage::store($request->file('image'), 'team');
        }

        TeamMember::query()->create($data);
        Inertia::flash('toast', ['type' => 'success', 'message' => __('flash.saved')]);

        return to_route('admin.team.index');
    }

    public function edit(TeamMember $team): Response
    {
        return Inertia::render('admin/Team/Form', ['member' => $team]);
    }

    public function update(Request $request, TeamMember $team): RedirectResponse
    {
        $data = $this->validated($request);

        if ($request->hasFile('image')) {
            MediaStorage::delete($team->image);
            $data['image'] = MediaStorage::store($request->file('image'), 'team');
        }

        $team->update($data);
        Inertia::flash('toast', ['type' => 'success', 'message' => __('flash.saved')]);

        return to_route('admin.team.index');
    }

    public function destroy(TeamMember $team): RedirectResponse
    {
        MediaStorage::delete($team->image);
        $team->delete();
        Inertia::flash('toast', ['type' => 'success', 'message' => __('flash.deleted')]);

        return to_route('admin.team.index');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'sort_order' => ['integer', 'min:0'],
            'is_active' => ['nullable'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
