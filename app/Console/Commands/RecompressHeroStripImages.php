<?php

namespace App\Console\Commands;

use App\Models\HeroStripImage;
use App\Services\ImageOptimizer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RecompressHeroStripImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:recompress-hero-strip-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Re-encode existing hero strip images in place at the tight 1000px/50KB cap (they were originally saved at the full-hero-background 2000px/285KB cap)';

    public function handle(): int
    {
        foreach (HeroStripImage::all() as $strip) {
            $path = Storage::disk('public')->path($strip->image);

            if (! is_file($path)) {
                $this->warn("Skipping {$strip->image} — file missing");

                continue;
            }

            $before = filesize($path);
            ImageOptimizer::toWebp($path, $path, 1000, 51200);
            clearstatcache(true, $path);
            $after = filesize($path);

            $this->line("{$strip->image}: ".round($before / 1024, 1).'KB -> '.round($after / 1024, 1).'KB');
        }

        return self::SUCCESS;
    }
}
