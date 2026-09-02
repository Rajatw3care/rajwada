<?php

use App\Services\ImageOptimizer;

test('it converts a large jpeg into a size-capped webp file', function () {
    $sourcePath = sys_get_temp_dir().'/pest-image-optimizer-source.jpg';
    $destPath = sys_get_temp_dir().'/pest-image-optimizer-dest.webp';

    $image = imagecreatetruecolor(3000, 2000);
    mt_srand(7);
    for ($i = 0; $i < 2000; $i++) {
        $color = imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
        imagefilledellipse($image, mt_rand(0, 3000), mt_rand(0, 2000), mt_rand(20, 200), mt_rand(20, 200), $color);
    }
    imagejpeg($image, $sourcePath, 100);
    imagedestroy($image);

    ImageOptimizer::toWebp($sourcePath, $destPath);

    expect(file_exists($destPath))->toBeTrue();
    expect(filesize($destPath))->toBeLessThanOrEqual(300 * 1024);

    $info = getimagesize($destPath);
    expect($info['mime'])->toBe('image/webp');
    expect(max($info[0], $info[1]))->toBeLessThanOrEqual(2000);

    @unlink($sourcePath);
    @unlink($destPath);
});

test('it preserves transparency for a png with an alpha channel', function () {
    $sourcePath = sys_get_temp_dir().'/pest-image-optimizer-alpha-source.png';
    $destPath = sys_get_temp_dir().'/pest-image-optimizer-alpha-dest.webp';

    $image = imagecreatetruecolor(300, 300);
    imagesavealpha($image, true);
    $transparent = imagecolorallocatealpha($image, 0, 0, 0, 127);
    imagefill($image, 0, 0, $transparent);
    $opaque = imagecolorallocate($image, 200, 30, 30);
    imagefilledellipse($image, 150, 150, 200, 200, $opaque);
    imagepng($image, $sourcePath);
    imagedestroy($image);

    ImageOptimizer::toWebp($sourcePath, $destPath);

    expect(file_exists($destPath))->toBeTrue();
    $info = getimagesize($destPath);
    expect($info['mime'])->toBe('image/webp');

    @unlink($sourcePath);
    @unlink($destPath);
});
