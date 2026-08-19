<?php

namespace App\Http\Controllers;

use App\Models\AboutContent;
use App\Models\BlogPost;
use App\Models\ContactMessage;
use App\Models\GalleryImage;
use App\Models\HeroContent;
use App\Models\HeroStripImage;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\TickerItem;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        return view('frontend.home', [
            'settings' => Setting::pluck('value', 'key'),
            'hero' => HeroContent::first(),
            'heroStripImages' => HeroStripImage::orderBy('sort_order')->get(),
            'tickerItems' => TickerItem::orderBy('sort_order')->get(),
            'about' => AboutContent::first(),
            'services' => Service::where('is_active', true)->orderBy('sort_order')->get(),
            'galleryImages' => GalleryImage::where('is_active', true)->orderBy('sort_order')->get(),
            'blogPosts' => BlogPost::where('is_active', true)->orderBy('sort_order')->get(),
            'testimonials' => Testimonial::where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'Thank you — we will be in touch shortly.');
    }
}
