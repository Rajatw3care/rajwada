<?php

use App\Models\GalleryImage;

function galleryColumnFigureCounts(string $html, string $wrapperClass): array
{
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();
    $xpath = new DOMXPath($dom);

    // token-exact class match: contains(@class,'hide') would also match 'hide-mobile'
    $wrap = $xpath->query("//div[contains(concat(' ', normalize-space(@class), ' '), ' gallery__grid_scroll ') and contains(concat(' ', normalize-space(@class), ' '), ' {$wrapperClass} ')]")->item(0);
    if (! $wrap) {
        return [];
    }

    $counts = [];
    foreach ($xpath->query(".//div[contains(@class,'gallery-column')]", $wrap) as $column) {
        $track = $xpath->query(".//div[contains(@class,'gallery-track')]", $column)->item(0);
        $total = $xpath->query('.//figure', $track)->length;
        $duplicates = $xpath->query('.//figure[@aria-hidden="true"]', $track)->length;
        $counts[] = ['total' => $total, 'duplicates' => $duplicates];
    }

    return $counts;
}

test('desktop gallery renders exactly 4 columns, each duplicated for a seamless loop', function () {
    GalleryImage::factory()->count(13)->create(['is_active' => true]);

    $html = $this->get(route('home'))->getContent();
    $columns = galleryColumnFigureCounts($html, 'hide-mobile');

    expect($columns)->toHaveCount(4);
    foreach ($columns as $column) {
        // every track must contain exactly two identical halves (real + aria-hidden duplicate)
        expect($column['total'])->toBe($column['duplicates'] * 2);
        expect($column['duplicates'])->toBeGreaterThan(0);
    }
});

test('mobile gallery renders exactly 3 columns, each duplicated for a seamless loop', function () {
    GalleryImage::factory()->count(13)->create(['is_active' => true]);

    $html = $this->get(route('home'))->getContent();
    $columns = galleryColumnFigureCounts($html, 'hide');

    expect($columns)->toHaveCount(3);
    foreach ($columns as $column) {
        expect($column['total'])->toBe($column['duplicates'] * 2);
        expect($column['duplicates'])->toBeGreaterThan(0);
    }
});

test('gallery columns stay correct with an image count not divisible by 4 or 3', function () {
    GalleryImage::factory()->count(10)->create(['is_active' => true]);

    $html = $this->get(route('home'))->getContent();

    $desktop = galleryColumnFigureCounts($html, 'hide-mobile');
    $mobile = galleryColumnFigureCounts($html, 'hide');

    expect($desktop)->toHaveCount(4);
    expect($mobile)->toHaveCount(3);

    // 10 images round-robin over 4 columns => sizes [3,3,2,2]; over 3 columns => [4,3,3]
    $desktopRealCounts = collect($desktop)->pluck('duplicates')->sort()->values()->all();
    $mobileRealCounts = collect($mobile)->pluck('duplicates')->sort()->values()->all();

    expect($desktopRealCounts)->toBe([2, 2, 3, 3]);
    expect($mobileRealCounts)->toBe([3, 3, 4]);
});

test('gallery does not render broken empty columns when there are fewer images than columns', function () {
    GalleryImage::factory()->count(2)->create(['is_active' => true]);

    $html = $this->get(route('home'))->getContent();

    $desktop = galleryColumnFigureCounts($html, 'hide-mobile');

    // only 2 images distributed round-robin over 4 columns => only 2 non-empty columns render
    expect($desktop)->toHaveCount(2);
});
