<?php

namespace App\Services;

class ImageOptimizer
{
    /**
     * Convert an image file to a size-capped WebP file.
     *
     * SVGs are left untouched (already tiny/vector) — the caller should
     * detect that case itself and just copy the file when needed.
     */
    public static function toWebp(string $sourcePath, string $destinationPath, int $maxDimension = 2000, int $targetBytes = 291840): void
    {
        $image = self::load($sourcePath);
        $image = self::resizeTo($image, $maxDimension);

        $directory = dirname($destinationPath);
        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        self::saveUnderTarget($image, $destinationPath, $targetBytes);
        imagedestroy($image);
    }

    protected static function load(string $path)
    {
        $info = getimagesize($path);

        $image = match ($info[2] ?? null) {
            IMAGETYPE_PNG => imagecreatefrompng($path),
            IMAGETYPE_GIF => imagecreatefromgif($path),
            IMAGETYPE_WEBP => imagecreatefromwebp($path),
            IMAGETYPE_JPEG => imagecreatefromjpeg($path),
            default => throw new \RuntimeException("Unsupported image type: {$path}"),
        };

        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);

        return $image;
    }

    protected static function resizeTo($image, int $maxDimension)
    {
        $width = imagesx($image);
        $height = imagesy($image);

        if (max($width, $height) <= $maxDimension) {
            return $image;
        }

        $scale = $maxDimension / max($width, $height);
        $newWidth = max(1, (int) round($width * $scale));
        $newHeight = max(1, (int) round($height * $scale));

        $resized = imagecreatetruecolor($newWidth, $newHeight);
        imagealphablending($resized, false);
        imagesavealpha($resized, true);
        $transparent = imagecolorallocatealpha($resized, 0, 0, 0, 127);
        imagefilledrectangle($resized, 0, 0, $newWidth, $newHeight, $transparent);
        imagecopyresampled($resized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagedestroy($image);

        return $resized;
    }

    protected static function saveUnderTarget($image, string $destinationPath, int $targetBytes): void
    {
        $qualities = [82, 75, 68, 60, 52, 45, 38, 30];

        foreach ($qualities as $quality) {
            imagewebp($image, $destinationPath, $quality);
            clearstatcache(true, $destinationPath);
            if (filesize($destinationPath) <= $targetBytes) {
                return;
            }
        }

        // still too big at the lowest quality: shrink dimensions once more and retry
        $width = imagesx($image);
        $height = imagesy($image);
        $image = self::resizeTo($image, (int) round(max($width, $height) * 0.7));

        foreach ([50, 40, 32, 25] as $quality) {
            imagewebp($image, $destinationPath, $quality);
            clearstatcache(true, $destinationPath);
            if (filesize($destinationPath) <= $targetBytes) {
                return;
            }
        }
    }
}
