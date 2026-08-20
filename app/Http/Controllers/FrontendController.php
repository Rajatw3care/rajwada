<?php

namespace App\Http\Controllers;

use App\Models\AboutContent;
use App\Models\BlogPost;
use App\Models\Ceremony;
use App\Models\ContactMessage;
use App\Models\GalleryImage;
use App\Models\HeroContent;
use App\Models\HeroStripImage;
use App\Models\Partner;
use App\Models\Service;
use App\Models\Setting;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\TickerItem;
use App\Models\TimelineItem;
use App\Models\WhyChooseItem;
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

    public function about()
    {
        return view('frontend.about', [
            'settings' => Setting::pluck('value', 'key'),
            'about' => AboutContent::first(),
            'timelineItems' => TimelineItem::orderBy('sort_order')->get(),
            'whyChooseItems' => WhyChooseItem::where('is_active', true)->orderBy('sort_order')->get(),
            'partners' => Partner::where('is_active', true)->orderBy('sort_order')->get(),
            'teamMembers' => TeamMember::where('is_active', true)->orderBy('sort_order')->get(),
            'ceremonies' => Ceremony::where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^[0-9]{7,15}$/'],
            'email' => ['required', 'email:filter', 'max:255'],
            'message' => ['required', 'string', 'min:5', 'max:5000'],
        ], [
            'name.required' => 'Please enter your name.',
            'name.min' => 'Your name looks too short.',
            'phone.required' => 'Please enter a phone number.',
            'phone.regex' => 'Phone number should contain digits only (7–15 digits).',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'message.required' => 'Please tell us a little about your event.',
            'message.min' => 'Please add a few more details about your event.',
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'Thank you — we will be in touch shortly.');
    }
}
