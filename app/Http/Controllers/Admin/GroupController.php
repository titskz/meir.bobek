<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Support\MediaStorage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class GroupController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('admin/Groups/Index', [
            'groups' => Group::query()->orderBy('sort_order')->orderBy('title')->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('admin/Groups/Form', ['group' => null]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        if ($request->hasFile('image')) {
            $data['image'] = MediaStorage::store($request->file('image'), 'groups');
        }

        Group::query()->create($data);
        Inertia::flash('toast', ['type' => 'success', 'message' => __('flash.saved')]);

        return to_route('admin.groups.index');
    }

    public function edit(Group $group): Response
    {
        return Inertia::render('admin/Groups/Form', ['group' => $group]);
    }

    public function update(Request $request, Group $group): RedirectResponse
    {
        $data = $this->validated($request, $group);

        if ($request->hasFile('image')) {
            MediaStorage::delete($group->image);
            $data['image'] = MediaStorage::store($request->file('image'), 'groups');
        }

        $group->update($data);
        Inertia::flash('toast', ['type' => 'success', 'message' => __('flash.saved')]);

        return to_route('admin.groups.index');
    }

    public function destroy(Group $group): RedirectResponse
    {
        MediaStorage::delete($group->image);
        $group->delete();
        Inertia::flash('toast', ['type' => 'success', 'message' => __('flash.deleted')]);

        return to_route('admin.groups.index');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, ?Group $group = null): array
    {
        $slug = Str::slug((string) ($request->input('slug') ?: $request->input('title')));
        $request->merge(['slug' => $slug ?: 'group-'.Str::lower(Str::random(8))]);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                'alpha_dash:ascii',
                Rule::unique('groups', 'slug')->ignore($group?->id),
            ],
            'content' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'sort_order' => ['integer', 'min:0'],
            'is_active' => ['nullable'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
