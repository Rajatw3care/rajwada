<?php

use App\Http\Controllers\AboutContentController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GalleryImageController;
use App\Http\Controllers\HeroContentController;
use App\Http\Controllers\HeroStripImageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\TickerItemController;
use App\Http\Controllers\UserController;
use App\Models\BlogPost;
use App\Models\ContactMessage;
use App\Models\GalleryImage;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::post('/contact', [FrontendController::class, 'submitContact'])->name('contact.submit');

Route::get('/deploy.php', function () {
    require public_path('deploy.php');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'title' => 'Dashboard',
            'stats' => [
                'services' => Service::count(),
                'gallery' => GalleryImage::count(),
                'blogPosts' => BlogPost::count(),
                'testimonials' => Testimonial::count(),
                'unreadMessages' => ContactMessage::where('is_read', false)->count(),
                'totalMessages' => ContactMessage::count(),
            ],
            'recentMessages' => ContactMessage::latest()->limit(5)->get(),
        ]);
    })->name('dashboard');

    Route::resource('users', UserController::class);

    Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

    Route::get('hero', [HeroContentController::class, 'edit'])->name('hero.edit');
    Route::put('hero', [HeroContentController::class, 'update'])->name('hero.update');
    Route::resource('hero-strip-images', HeroStripImageController::class)->except(['show', 'edit', 'update']);
    Route::resource('ticker-items', TickerItemController::class)->except(['show']);

    Route::get('about', [AboutContentController::class, 'edit'])->name('about.edit');
    Route::put('about', [AboutContentController::class, 'update'])->name('about.update');

    Route::resource('services', ServiceController::class)->except(['show']);
    Route::resource('gallery-images', GalleryImageController::class)->except(['show']);
    Route::resource('blog-posts', BlogPostController::class)->except(['show']);
    Route::resource('testimonials', TestimonialController::class)->except(['show']);

    Route::resource('contact-messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);
});

require __DIR__.'/auth.php';
