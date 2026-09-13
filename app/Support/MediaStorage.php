<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;

class MediaStorage
{
    public static function store(UploadedFile $file, string $directory = 'uploads'): string
    {
        $filename = Str::uuid()->toString().'.'.$file->extension();

        $path = $file->storeAs($directory, $filename, 'public');

        if ($path === false) {
            throw new RuntimeException('Unable to store the uploaded media file.');
        }

        return $path;
    }

    public static function delete(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    public static function url(?string $path): ?string
    {
        return $path ? Storage::disk('public')->url($path) : null;
    }
}
