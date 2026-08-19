<?php

namespace Database\Seeders;

use App\Models\AboutContent;
use App\Models\BlogPost;
use App\Models\GalleryImage;
use App\Models\HeroContent;
use App\Models\HeroStripImage;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\TickerItem;
use Illuminate\Database\Seeder;

class RajwadaContentSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => 'Rajwada Events',
            'site_tagline' => 'The Royal Creators',
            'meta_description' => 'Rajwada Events crafts timeless celebrations — luxury weddings and extraordinary events in Jaipur and beyond.',
            'logo' => 'site/logo.png',
            'phone' => '+91 94144 99933',
            'whatsapp' => '+91 97722 50557',
            'email' => 'info@rajwadaevents.com',
            'address' => 'Jaipur, Rajasthan, India',
            'collaboration_email' => 'info@rajwadaevent.com',
            'careers_email' => 'info@rajwadaevent.com',
            'footer_copyright' => '©2026 Rajwada Events | All Rights Reserved.',
        ];
        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        HeroContent::updateOrCreate(['id' => 1], [
            'eyebrow' => 'Crafting',
            'title' => 'Timeless Celebration',
            'subtitle' => 'Luxury Weddings & Extraordinary Events In Jaipur & Beyond',
            'main_image' => 'site/hero/hero-lake.jpg',
            'cta_1_label' => 'Plan Your Event',
            'cta_1_link' => '#contact',
            'cta_2_label' => 'View Portfolio',
            'cta_2_link' => '#gallery',
        ]);

        HeroStripImage::query()->delete();
        foreach (range(1, 5) as $i) {
            HeroStripImage::create([
                'image' => "site/hero/hero-strip-{$i}.jpg",
                'sort_order' => $i,
            ]);
        }

        TickerItem::query()->delete();
        foreach (['Destination Wedding', 'Jaipur & Samod', 'Heritage Palace', 'Bespoke Styling', '120+ Celebrations'] as $i => $text) {
            TickerItem::create(['text' => $text, 'sort_order' => $i]);
        }

        AboutContent::updateOrCreate(['id' => 1], [
            'heading' => 'About Us',
            'body' => "<p>At Rajwada Events we transform your dreams into unforgettable celebrations. Founded by Ajay Soukal in 2016, our vision is rooted in Rajasthan's rich heritage and artistic traditions.</p><p>With over 40 successful weddings and events, we bring creativity, elegance, and flawless execution to every occasion. From intimate celebrations to grand royal weddings, every event is thoughtfully crafted around your unique story.</p><p>Our passionate team blends traditional grandeur with contemporary sophistication, paying attention to every detail. From venue styling and decor to seamless event management, we bring every element together with precision and passion.</p><p>With Rajwada Events, you don't just celebrate an occasion &mdash; you create memories that last a lifetime.</p><p><strong>RAJWADA EVENTS &mdash; WHERE TIMELESS TRADITIONS MEET EXTRAORDINARY CELEBRATIONS</strong></p>",
            'image_1' => 'site/about/about-2.jpg',
            'image_2' => 'site/about/about-1.jpg',
            'image_3' => 'site/about/about-3.jpg',
            'badge_image' => 'site/about/10-plus-year.svg',
            'cta_label' => 'Explore More',
            'cta_link' => '#services',
        ]);

        Service::query()->delete();
        $services = [
            ['icon-mehendi.png', 'Mehendi Artist'],
            ['icon-makeup.png', 'Makeup Artist'],
            ['icon-dhol.png', 'Dhol Artist'],
            ['icon-barat.png', 'Baraat Procession'],
            ['icon-planning.png', 'Planning Wow Factors'],
            ['icon-panditji.png', 'Panditji'],
            ['icon-favours.png', 'Wedding Favours'],
            ['icon-choreographer.png', 'Choreographer'],
        ];
        foreach ($services as $i => [$icon, $title]) {
            Service::create([
                'icon' => "site/services/{$icon}",
                'title' => $title,
                'description' => 'We help you choose the best '.strtolower($title).' and manage everything from applications to billing, ensuring a smooth and joyful experience.',
                'sort_order' => $i,
                'is_active' => true,
            ]);
        }

        GalleryImage::query()->delete();
        $galleryAlts = [
            'Bridal hands with mehendi and red bangles',
            'Family portrait in traditional Rajasthani attire',
            'Banquet hall styled for a reception',
            'Decorated elephant before Hawa Mahal',
            'Couple under a floral chandelier mandap',
            'Emerald and gold mandap entrance',
            'Couple dancing amid sparkler fountains',
            'Bridesmaids in pastel lehengas under a tree',
        ];
        foreach (range(1, 8) as $i) {
            GalleryImage::create([
                'image' => "site/gallery/gallery-{$i}.jpg",
                'alt_text' => $galleryAlts[$i - 1],
                'sort_order' => $i,
                'is_active' => true,
            ]);
        }

        BlogPost::query()->delete();
        $blogs = [
            ['blog-1.jpg', 'Nishuraj resort / Haryana'],
            ['blog-2.jpg', 'Lalgarh palace / Bikaner'],
            ['blog-3.jpg', 'Araliayas Resort / Udaipur'],
        ];
        foreach ($blogs as $i => [$image, $venue]) {
            BlogPost::create([
                'title' => 'Luxury Wedding & Extraordinary Event In Jaipur & Beyond',
                'image' => "site/blog/{$image}",
                'venue' => $venue,
                'excerpt' => 'Explore our latest wedding stories, ideas, and inspiration to make your celebration truly unforgettable.',
                'body' => 'Explore our latest wedding stories, ideas, and inspiration to make your celebration truly unforgettable.',
                'sort_order' => $i,
                'is_active' => true,
                'published_at' => now(),
            ]);
        }

        Testimonial::query()->delete();
        foreach (range(1, 3) as $i) {
            Testimonial::create([
                'name' => 'Happy Client',
                'avatar' => "site/testimonials/avatar-{$i}.jpg",
                'message' => 'We help you choose the best mehendi artist and manage everything from applications to billing, ensuring a smooth and joyful experience.',
                'sort_order' => $i,
                'is_active' => true,
            ]);
        }
    }
}
