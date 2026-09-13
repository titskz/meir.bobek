<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Support\MediaStorage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('admin/Pages/Index', [
            'pages' => Page::query()->orderBy('sort_order')->orderBy('title')->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('admin/Pages/Form', [
            'page' => null,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        if ($request->hasFile('image')) {
            $data['image'] = MediaStorage::store($request->file('image'), 'pages');
        }

        Page::query()->create($data);

        Inertia::flash('toast', ['type' => 'success', 'message' => __('flash.saved')]);

        return to_route('admin.pages.index');
    }

    public function edit(Page $page): Response
    {
        return Inertia::render('admin/Pages/Form', [
            'page' => $page,
        ]);
    }

    public function update(Request $request, Page $page): RedirectResponse
    {
        $data = $this->validated($request, $page);

        if ($request->hasFile('image')) {
            MediaStorage::delete($page->image);
            $data['image'] = MediaStorage::store($request->file('image'), 'pages');
        }

        $page->update($data);

        Inertia::flash('toast', ['type' => 'success', 'message' => __('flash.saved')]);

        return to_route('admin.pages.index');
    }

    public function destroy(Page $page): RedirectResponse
    {
        MediaStorage::delete($page->image);
        $page->delete();

        Inertia::flash('toast', ['type' => 'success', 'message' => __('flash.deleted')]);

        return to_route('admin.pages.index');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, ?Page $page = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('pages', 'slug')->ignore($page?->id),
            ],
            'content' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'is_published' => ['nullable'],
            'sort_order' => ['integer', 'min:0'],
        ]);

        if (blank($data['slug'] ?? null)) {
            $data['slug'] = Str::slug($data['title']);
        }

        $data['is_published'] = $request->boolean('is_published');

        return $data;
    }
}
