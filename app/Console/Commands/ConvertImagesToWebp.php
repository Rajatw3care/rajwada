<?php

namespace App\Console\Commands;

use App\Models\AboutContent;
use App\Models\BlogPost;
use App\Models\Ceremony;
use App\Models\Destination;
use App\Models\GalleryImage;
use App\Models\HeroContent;
use App\Models\HeroStripImage;
use App\Models\Partner;
use App\Models\Service;
use App\Models\Setting;
use App\Models\SuccessStory;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\Video;
use App\Models\WhyChooseItem;
use App\Services\ImageOptimizer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ConvertImagesToWebp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:convert-images-to-webp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert every admin-uploaded image (across all content models) to a size-capped WebP file';

    /** @var array<string,string> old relative path => new relative path */
    protected array $converted = [];

    protected int $skipped = 0;

    protected int $failed = 0;

    public function handle(): int
    {
        $targets = [
            [AboutContent::class, ['image_1', 'image_2', 'image_3', 'badge_image', 'page_banner_image']],
            [BlogPost::class, ['image']],
            [Ceremony::class, ['icon']],
            [Destination::class, ['image']],
            [GalleryImage::class, ['image']],
            [HeroContent::class, ['main_image']],
            [HeroStripImage::class, ['image']],
            [Partner::class, ['logo']],
            [Service::class, ['icon', 'overview_image']],
            [SuccessStory::class, ['image']],
            [TeamMember::class, ['photo']],
            [Testimonial::class, ['avatar']],
            [Video::class, ['thumbnail']],
            [WhyChooseItem::class, ['icon']],
        ];

        // Pass 1: multiple records can point at the exact same underlying file
        // (e.g. a Service.overview_image reusing a GalleryImage.image path).
        // Convert each unique source file exactly once and remember the mapping,
        // so pass 2 can repoint every record — instead of the first record's
        // conversion deleting the file out from under the others.
        $allRecordsByColumn = [];
        foreach ($targets as [$modelClass, $columns]) {
            $records = $modelClass::all();
            $allRecordsByColumn[] = [$records, $columns];

            foreach ($records as $record) {
                foreach ($columns as $column) {
                    $this->convertUnique($record->{$column});
                }
            }
        }
        $this->convertUnique(Setting::where('key', 'logo')->value('value'));

        // Pass 2: repoint every record/column to the converted path.
        foreach ($allRecordsByColumn as [$records, $columns]) {
            foreach ($records as $record) {
                $dirty = false;
                foreach ($columns as $column) {
                    $old = $record->{$column};
                    if ($old && isset($this->converted[$old])) {
                        $record->{$column} = $this->converted[$old];
                        $dirty = true;
                    }
                }
                if ($dirty) {
                    $record->saveQuietly();
                }
            }
        }
        $setting = Setting::where('key', 'logo')->first();
        if ($setting && $setting->value && isset($this->converted[$setting->value])) {
            $setting->value = $this->converted[$setting->value];
            $setting->save();
        }

        // Pass 3: now that nothing references the old files any more, remove them.
        foreach (array_keys($this->converted) as $oldPath) {
            Storage::disk('public')->delete($oldPath);
        }

        $this->newLine();
        $this->info('Converted: '.count($this->converted)."   Skipped (already webp/svg/missing): {$this->skipped}   Failed: {$this->failed}");

        return self::SUCCESS;
    }

    protected function convertUnique(?string $path): void
    {
        if (blank($path) || isset($this->converted[$path])) {
            return;
        }

        if (Str::endsWith($path, ['.webp', '.svg'])) {
            $this->skipped++;

            return;
        }

        $fullPath = Storage::disk('public')->path($path);

        if (! is_file($fullPath)) {
            $this->skipped++;

            return;
        }

        $newRelativePath = Str::beforeLast($path, '.').'-'.Str::random(8).'.webp';
        $newFullPath = Storage::disk('public')->path($newRelativePath);

        try {
            ImageOptimizer::toWebp($fullPath, $newFullPath);
        } catch (\Throwable $e) {
            $this->failed++;
            $this->warn("Failed: {$path} — {$e->getMessage()}");

            return;
        }

        $this->converted[$path] = $newRelativePath;
        $this->line("Converted {$path} -> {$newRelativePath}");
    }
}
