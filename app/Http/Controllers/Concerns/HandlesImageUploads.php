<?php

namespace App\Http\Controllers\Concerns;

use App\Services\ImageOptimizer;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HandlesImageUploads
{
    protected function storeImage(UploadedFile $file, string $directory, ?string $oldPath = null, int $maxDimension = 2000, int $targetBytes = 291840): string
    {
        if ($oldPath) {
            Storage::disk('public')->delete($oldPath);
        }

        $directory = trim($directory, '/');

        // SVGs are already tiny/vector — keep them as-is instead of rasterizing.
        if ($file->getClientMimeType() === 'image/svg+xml' || strtolower($file->getClientOriginalExtension()) === 'svg') {
            return $file->store($directory, 'public');
        }

        $relativePath = $directory.'/'.Str::random(40).'.webp';

        ImageOptimizer::toWebp($file->getRealPath(), Storage::disk('public')->path($relativePath), $maxDimension, $targetBytes);

        return $relativePath;
    }
}
