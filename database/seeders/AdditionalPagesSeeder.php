<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Destination;
use App\Models\GalleryImage;
use App\Models\RatingStat;
use App\Models\Service;
use App\Models\Setting;
use App\Models\SuccessStory;
use App\Models\Testimonial;
use App\Models\Video;
use Illuminate\Database\Seeder;

class AdditionalPagesSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedServiceListing();
        $this->seedGalleryCategories();
        $this->seedVideos();
        $this->seedRatingStats();
        $this->seedSuccessStories();
        $this->seedDestinations();
        $this->updateBlogPosts();
        $this->updateTestimonials();
        $this->seedContactSettings();
    }

    protected function seedServiceListing(): void
    {
        $services = [
            ['icon-licenses.png', 'Venue Booking', 'From heritage havelis to lakeside lawns, we scout and secure the perfect venue for your celebration.', 'site/hero/hero-lake.jpg', "Heritage havelis, lakeside lawns & palace grounds, hand-picked for your celebration."],
            ['icon-favours.png', 'Design & Concepts for Events', 'Bespoke themes, colour palettes and decor concepts crafted to reflect your story and royal heritage.', 'site/gallery/gallery-6.jpg', 'Themes, decor & colour stories built around your vision and heritage.'],
            ['icon-planning.png', 'Planning & Management', 'End-to-end planning that keeps every vendor, timeline and detail perfectly in sync from start to finish.', 'site/about/about-3.jpg', 'Every vendor and moving part managed so your day runs without a hitch.'],
            ['icon-choreographer.png', 'Event Entertainment, Artists & Celebrity Management', 'Curated performers, live bands and celebrity acts booked and managed to keep your guests spellbound.', 'site/hero/hero-strip-3.jpg', 'Live acts, bands & celebrity performances curated to suit your crowd.'],
            [null, 'Photography & Videography', 'Cinematic films and candid photography that capture every emotion and ritual beautifully.', 'site/blog/blog-1.jpg', 'Cinematic films & candid frames that relive every ceremony forever.'],
            ['icon-dhol.png', 'Conceptual Bride & Groom Entry', 'Grand, story-driven entries designed around your personalities — from floral chariots to dramatic reveals.', 'site/gallery/gallery-5.jpg', 'Story-driven entries — from floral chariots to dramatic, choreographed reveals.'],
            ['icon-panditji.png', 'Conceptual Varmala Exchange Ceremony', 'A jaimala ceremony styled with dramatic staging, florals and lighting for your most photographed moment.', 'site/hero/hero-strip-1.jpg', 'Staged, lit & styled for the most photographed moment of the day.'],
            ['icon-operations.png', 'Logistics & Hospitality Management', 'Seamless guest travel, stay and on-ground coordination so every visitor feels warmly looked after.', 'site/gallery/gallery-2.jpg', 'Guest travel, stay & on-ground care so every visitor feels welcomed.'],
            ['icon-barat.png', 'Royal Baraat Procession', 'Traditional baraats with decorated elephants, horses, dhol and fireworks for an unforgettable entrance.', 'site/gallery/gallery-4.jpg', 'Decorated elephants, horses, dhol & fireworks for a royal entrance.'],
            [null, 'Catering & Wedding Menu Planning', 'Curated menus blending royal Rajasthani cuisine with contemporary flavours, tailored to your guests.', 'site/blog/blog-2.jpg', 'Royal Rajasthani flavours reimagined for the modern wedding table.'],
            [null, 'Event Timeline Management', 'A minute-by-minute schedule that keeps every ceremony and transition running smoothly on the day.', 'site/hero/hero-strip-2.jpg', 'A precise, minute-by-minute schedule for every ceremony and transition.'],
            [null, 'Wedding Invitations', 'Elegant, custom-designed invitations and digital save-the-dates that set the tone for your celebration.', 'site/gallery/gallery-7.jpg', 'Custom invitation suites & digital save-the-dates that set the tone.'],
            ['icon-makeup.png', 'Makeup & Styling', 'Expert bridal makeup and styling teams for a flawless, camera-ready look through every ceremony.', 'site/gallery/gallery-1.jpg', 'Flawless, camera-ready bridal looks through every ceremony of your event.'],
            [null, 'Transportation Management', 'Comfortable, well-coordinated transport for the couple, family and guests across every venue.', 'site/hero/hero-strip-5.jpg', 'Well-coordinated transport for the couple, family & guests, venue to venue.'],
        ];

        foreach ($services as $i => [$icon, $title, $description, $overviewImage, $overviewDescription]) {
            Service::updateOrCreate(
                ['title' => $title, 'show_on_homepage' => false],
                [
                    'icon' => $icon ? "site/services/{$icon}" : null,
                    'description' => $description,
                    'overview_image' => $overviewImage,
                    'overview_description' => $overviewDescription,
                    'sort_order' => $i,
                    'is_active' => true,
                ]
            );
        }
    }

    protected function seedGalleryCategories(): void
    {
        $meta = [
            1 => ['Bridal Mehendi & Bangles', 'mehendi'],
            2 => ['A Royal Family Portrait', 'sangeet'],
            3 => ['An Evening at the Banquet', 'reception'],
            4 => ['Baraat on Elephant Back', 'royal'],
            5 => ['Beneath the Floral Chandelier', 'royal'],
            6 => ['Emerald & Gold Mandap', 'royal'],
            7 => ['Sparkler Fountain First Dance', 'sangeet'],
            8 => ['Under the Floral Canopy', 'haldi'],
        ];

        foreach ($meta as $i => [$title, $category]) {
            GalleryImage::where('image', "site/gallery/gallery-{$i}.jpg")->update([
                'title' => $title,
                'category' => $category,
            ]);
        }
    }

    protected function seedVideos(): void
    {
        Video::query()->delete();

        $galleryVideos = [
            ['site/hero/hero-strip-1.jpg', 'The Royal Vows', 'Wedding Film', '04:12'],
            ['site/hero/hero-strip-4.jpg', 'Sangeet Nights', 'Highlight Reel', '02:47'],
            ['site/about/about-2.jpg', 'Destination Diaries', 'Wedding Film', '05:30'],
            ['site/gallery/gallery-8.jpg', 'Haldi & Mehendi Moments', 'Highlight Reel', '03:05'],
        ];
        foreach ($galleryVideos as $i => [$thumb, $title, $tag, $duration]) {
            Video::create([
                'category' => 'gallery',
                'thumbnail' => $thumb,
                'title' => $title,
                'tag' => $tag,
                'duration' => $duration,
                'video_url' => 'https://www.youtube.com/@rajwadaevents',
                'sort_order' => $i,
                'is_active' => true,
            ]);
        }

        $testimonialVideos = [
            ['site/hero/hero-strip-1.jpg', "Ritu & Aman's Story", 'Client Testimonial', '02:18'],
            ['site/about/about-2.jpg', 'The Mehta Family Speaks', 'Client Testimonial', '01:54'],
            ['site/hero/hero-strip-4.jpg', "Kavya on Her Sangeet Night", 'Client Testimonial', '02:41'],
            ['site/gallery/gallery-8.jpg', "Neha & Rohit's Royal Wedding", 'Client Testimonial', '03:07'],
        ];
        foreach ($testimonialVideos as $i => [$thumb, $title, $tag, $duration]) {
            Video::create([
                'category' => 'testimonial',
                'thumbnail' => $thumb,
                'title' => $title,
                'tag' => $tag,
                'duration' => $duration,
                'video_url' => 'https://www.youtube.com/@rajwadaevents',
                'sort_order' => $i,
                'is_active' => true,
            ]);
        }
    }

    protected function seedRatingStats(): void
    {
        RatingStat::query()->delete();
        $stats = [
            ['⭐', '4.9 / 5', 'Average Client Rating'],
            ['👨‍👩‍👧‍👦', '500+', 'Happy Families & Couples'],
            ['🏆', '50+', 'Awards & Features'],
            ['👑', '10+', 'Years of Trusted Legacy'],
        ];
        foreach ($stats as $i => [$icon, $number, $label]) {
            RatingStat::create(['icon' => $icon, 'number' => $number, 'label' => $label, 'sort_order' => $i]);
        }
    }

    protected function seedSuccessStories(): void
    {
        SuccessStory::query()->delete();
        $stories = [
            ['site/gallery/gallery-4.jpg', 'Jaipur, Rajasthan', 'A Royal Union at Jaipur', 'An elephant-led baraat before Hawa Mahal set the tone for a three-day royal wedding steeped in heritage and grandeur.'],
            ['site/blog/blog-2.jpg', 'Lalgarh Palace, Bikaner', 'Destination Vows at Lalgarh', 'Floral chandeliers and sandstone courtyards framed an intimate destination wedding for a couple who wanted history as their backdrop.'],
            ['site/blog/blog-3.jpg', 'Araliayas Resort, Udaipur', 'Garden Romance at Araliayas', 'A lakeside resort transformed into a floral canopy affair, blending contemporary styling with soft Rajasthani textures.'],
            ['site/hero/hero-strip-4.jpg', 'Samod Palace, Jaipur', 'Sangeet Under The Stars', 'A courtyard sangeet at Samod Palace, lit end to end with fairy lights, live music and a dance floor that never emptied.'],
            ['site/blog/blog-1.jpg', 'Nishuraj Resort, Haryana', 'An Intimate Resort Wedding', 'A close-knit guest list, a petal-shower entry and a menu built around family recipes made this one truly personal.'],
            ['site/gallery/gallery-6.jpg', 'Heritage Venue, Jaipur', 'Emerald Nights At The Mandap', "An emerald-and-gold mandap entrance anchored a celebration built entirely around the couple's favourite colour story."],
        ];
        foreach ($stories as $i => [$image, $location, $title, $description]) {
            SuccessStory::create([
                'image' => $image,
                'location' => $location,
                'title' => $title,
                'description' => $description,
                'sort_order' => $i,
                'is_active' => true,
            ]);
        }
    }

    protected function seedDestinations(): void
    {
        Destination::query()->delete();
        $destinations = [
            ['site/gallery/gallery-4.jpg', 'Jaipur', '18+ Celebrations'],
            ['site/hero/hero-strip-5.jpg', 'Samod', '9+ Celebrations'],
            ['site/about/about-2.jpg', 'Udaipur', '12+ Celebrations'],
            ['site/hero/hero-strip-2.jpg', 'Bikaner', '7+ Celebrations'],
            ['site/hero/hero-strip-1.jpg', 'Haryana', '5+ Celebrations'],
        ];
        foreach ($destinations as $i => [$image, $name, $count]) {
            Destination::create([
                'image' => $image,
                'name' => $name,
                'count_label' => $count,
                'sort_order' => $i,
                'is_active' => true,
            ]);
        }
    }

    protected function updateBlogPosts(): void
    {
        $meta = [
            'Lalgarh palace / Bikaner' => ['Real Weddings', 'Real Wedding, Palace Wedding, Bikaner, Baraat, Sangeet', true],
            'Nishuraj resort / Haryana' => ['Planning Tips', 'Mehendi, Décor, Reception', false],
            'Araliayas Resort / Udaipur' => ['Destination Weddings', 'Destination Weddings, Décor, Palace Wedding', false],
        ];
        foreach ($meta as $venue => [$category, $tags, $featured]) {
            BlogPost::where('venue', $venue)->update([
                'category' => $category,
                'tags' => $tags,
                'is_featured' => $featured,
            ]);
        }
    }

    protected function updateTestimonials(): void
    {
        $events = [
            'Royal Family Wedding — Jaipur',
            'Sangeet Night — Udaipur',
            'Royal Wedding — Jaipur',
        ];
        $testimonials = Testimonial::orderBy('sort_order')->get();
        foreach ($testimonials as $i => $testimonial) {
            $testimonial->update([
                'event_label' => $events[$i] ?? null,
                'rating' => 5,
                'is_featured' => true,
            ]);
        }
    }

    protected function seedContactSettings(): void
    {
        $settings = [
            'office_hours' => 'Mon–Sat, 10 AM–7 PM',
            'map_embed_url' => 'https://www.google.com/maps?q=Jaipur,Rajasthan,India&output=embed',
        ];
        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
