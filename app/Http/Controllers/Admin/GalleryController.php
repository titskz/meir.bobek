<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use App\Support\MediaStorage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class GalleryController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('admin/Gallery/Index', [
            'items' => GalleryItem::query()->orderBy('sort_order')->orderBy('title')->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('admin/Gallery/Form', ['item' => null]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['image'] = MediaStorage::store($request->file('image'), 'gallery');

        GalleryItem::query()->create($data);
        Inertia::flash('toast', ['type' => 'success', 'message' => __('flash.saved')]);

        return to_route('admin.gallery.index');
    }

    public function edit(GalleryItem $gallery): Response
    {
        return Inertia::render('admin/Gallery/Form', ['item' => $gallery]);
    }

    public function update(Request $request, GalleryItem $gallery): RedirectResponse
    {
        $data = $this->validated($request, false);

        if ($request->hasFile('image')) {
            MediaStorage::delete($gallery->image);
            $data['image'] = MediaStorage::store($request->file('image'), 'gallery');
        } else {
            unset($data['image']);
        }

        $gallery->update($data);
        Inertia::flash('toast', ['type' => 'success', 'message' => __('flash.saved')]);

        return to_route('admin.gallery.index');
    }

    public function destroy(GalleryItem $gallery): RedirectResponse
    {
        MediaStorage::delete($gallery->image);
        $gallery->delete();
        Inertia::flash('toast', ['type' => 'success', 'message' => __('flash.deleted')]);

        return to_route('admin.gallery.index');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, bool $requireImage = true): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => [$requireImage ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'sort_order' => ['integer', 'min:0'],
            'is_active' => ['nullable'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
