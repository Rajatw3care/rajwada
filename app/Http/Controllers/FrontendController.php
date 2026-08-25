<?php

namespace App\Http\Controllers;

use App\Models\AboutContent;
use App\Models\BlogPost;
use App\Models\Ceremony;
use App\Models\ContactMessage;
use App\Models\Destination;
use App\Models\GalleryImage;
use App\Models\HeroContent;
use App\Models\HeroStripImage;
use App\Models\Partner;
use App\Models\RatingStat;
use App\Models\Service;
use App\Models\Setting;
use App\Models\SuccessStory;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\TickerItem;
use App\Models\TimelineItem;
use App\Models\Video;
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
            'services' => Service::where('is_active', true)->where('show_on_homepage', true)->orderBy('sort_order')->get(),
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

    public function services()
    {
        return view('frontend.services', [
            'settings' => Setting::pluck('value', 'key'),
            'services' => Service::where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function gallery()
    {
        return view('frontend.gallery', [
            'settings' => Setting::pluck('value', 'key'),
            'galleryImages' => GalleryImage::where('is_active', true)->orderBy('sort_order')->get(),
            'videos' => Video::where('category', 'gallery')->where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function testimonials()
    {
        return view('frontend.testimonials', [
            'settings' => Setting::pluck('value', 'key'),
            'testimonials' => Testimonial::where('is_active', true)->orderBy('sort_order')->get(),
            'featuredTestimonials' => Testimonial::where('is_active', true)->where('is_featured', true)->orderBy('sort_order')->get(),
            'videos' => Video::where('category', 'testimonial')->where('is_active', true)->orderBy('sort_order')->get(),
            'ratingStats' => RatingStat::orderBy('sort_order')->get(),
        ]);
    }

    public function contact()
    {
        return view('frontend.contact', [
            'settings' => Setting::pluck('value', 'key'),
        ]);
    }

    public function blogs(Request $request)
    {
        $search = trim((string) $request->query('q', ''));

        $blogPosts = BlogPost::where('is_active', true)
            ->when($search !== '', fn ($query) => $query->where(fn ($q) => $q
                ->where('title', 'like', "%{$search}%")
                ->orWhere('excerpt', 'like', "%{$search}%")
                ->orWhere('venue', 'like', "%{$search}%")
            ))
            ->orderByDesc('published_at')
            ->paginate(6)
            ->withQueryString();

        return view('frontend.blogs', [
            'settings' => Setting::pluck('value', 'key'),
            'blogPosts' => $blogPosts,
            'search' => $search,
            'featuredPost' => $search === '' ? BlogPost::where('is_active', true)->where('is_featured', true)->orderByDesc('published_at')->first() : null,
            'recentPosts' => BlogPost::where('is_active', true)->orderByDesc('published_at')->limit(5)->get(),
            'categories' => BlogPost::where('is_active', true)->whereNotNull('category')->groupBy('category')->selectRaw('category, count(*) as total')->pluck('total', 'category'),
            'popularTags' => $this->popularTags(),
        ]);
    }

    protected function popularTags(): array
    {
        return BlogPost::where('is_active', true)->whereNotNull('tags')->pluck('tags')
            ->flatMap(fn ($tags) => array_map('trim', explode(',', $tags)))
            ->filter()
            ->unique()
            ->take(8)
            ->values()
            ->all();
    }

    public function blogShow(string $slug)
    {
        $blogPost = BlogPost::where('slug', $slug)->where('is_active', true)->firstOrFail();

        return view('frontend.blog-detail', [
            'settings' => Setting::pluck('value', 'key'),
            'blogPost' => $blogPost,
            'recentPosts' => BlogPost::where('is_active', true)->orderByDesc('published_at')->limit(5)->get(),
            'categories' => BlogPost::where('is_active', true)->whereNotNull('category')->groupBy('category')->selectRaw('category, count(*) as total')->pluck('total', 'category'),
            'popularTags' => $this->popularTags(),
            'relatedPosts' => BlogPost::where('is_active', true)->where('id', '!=', $blogPost->id)->orderByDesc('published_at')->limit(3)->get(),
        ]);
    }

    public function successStory()
    {
        return view('frontend.success-story', [
            'settings' => Setting::pluck('value', 'key'),
            'successStories' => SuccessStory::where('is_active', true)->orderBy('sort_order')->get(),
            'destinations' => Destination::where('is_active', true)->orderBy('sort_order')->get(),
            'galleryImages' => GalleryImage::where('is_active', true)->orderBy('sort_order')->limit(8)->get(),
            'videos' => Video::where('category', 'gallery')->where('is_active', true)->orderBy('sort_order')->limit(4)->get(),
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
