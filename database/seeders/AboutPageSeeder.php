<?php

namespace Database\Seeders;

use App\Models\AboutContent;
use App\Models\Ceremony;
use App\Models\Partner;
use App\Models\TeamMember;
use App\Models\TimelineItem;
use App\Models\WhyChooseItem;
use Illuminate\Database\Seeder;

class AboutPageSeeder extends Seeder
{
    public function run(): void
    {
        AboutContent::updateOrCreate(['id' => 1], [
            'page_banner_image' => 'site/about/banner.jpg',
            'vision' => "To be Rajasthan's most trusted name in royal wedding and event experiences &mdash; where every celebration reflects timeless heritage, elegance and modern sophistication.",
            'mission' => 'To craft flawless, deeply personal celebrations by blending traditional grandeur with meticulous planning, so every couple lives their story exactly as they imagined it.',
            'core_values' => 'Heritage,Elegance,Precision,Trust,Passion',
        ]);

        TimelineItem::query()->delete();
        $timeline = [
            ['2016', 'The Beginning', "Ajay Soukal founded Rajwada Events in Jaipur, rooted in Rajasthan's rich heritage and artistic traditions."],
            ['2018', 'Growing Into Grandeur', 'We expanded into full-service destination wedding planning, partnering with palaces, resorts and heritage havelis across Rajasthan.'],
            ['2021', 'An In-House Family', 'Our in-house team of stylists, coordinators and designers came together, allowing every event to be crafted with one consistent vision.'],
            ['2023', 'The Royal Touch Signature', 'We introduced our signature Royal Touch ceremony experiences — Mehendi, Sangeet and Baraat, reimagined with theatrical, palace-inspired detail.'],
            ['Today', '120+ Celebrations & Counting', 'With over 120 celebrations delivered across Jaipur, Samod and beyond, Rajwada Events continues to craft memories that last a lifetime.'],
        ];
        foreach ($timeline as $i => [$year, $title, $desc]) {
            TimelineItem::create(['year' => $year, 'title' => $title, 'description' => $desc, 'sort_order' => $i]);
        }

        WhyChooseItem::query()->delete();
        $whyUs = [
            ['legacy.png', '10+ Years of Legacy', 'A decade of experience curating royal weddings and events across Rajasthan and beyond.'],
            ['iteration.png', 'End-to-End Operations', 'From the first consultation to the last guest departure, we manage every moving part in-house.'],
            ['certificate.png', 'Licensed & Insured', 'Fully licensed operations and vetted vendor partners, so every celebration is planned with complete peace of mind.'],
            ['trust.png', 'Trusted Vendor Network', "Long-standing relationships with Rajasthan's finest venues, decorators, caterers and artists."],
            ['red-carpet.png', 'Royal Attention to Detail', 'Every mandap, thaali and playlist is designed around your story — nothing is ever off-the-shelf.'],
            ['group-chat.png', 'A Passion-Led Team', 'A close-knit team that treats every celebration with the care and pride of planning our own.'],
        ];
        foreach ($whyUs as $i => [$icon, $title, $desc]) {
            WhyChooseItem::create([
                'icon' => "site/why-choose/{$icon}",
                'title' => $title,
                'description' => $desc,
                'sort_order' => $i,
                'is_active' => true,
            ]);
        }

        Partner::query()->delete();
        $partners = [
            ['altura.png', 'Altura'], ['brightlabs.png', 'BrightLabs'], ['orbit.png', 'Orbit'],
            ['novatech.png', 'NovaTech'], ['secureway.png', 'SecureWay'], ['fusionfirst.png', 'FusionFirst'],
            ['synergia.png', 'Synergia'], ['datastream.png', 'DataStream'],
        ];
        foreach ($partners as $i => [$logo, $name]) {
            Partner::create([
                'logo' => "site/partners/{$logo}",
                'name' => $name,
                'sort_order' => $i,
                'is_active' => true,
            ]);
        }

        TeamMember::query()->delete();
        $team = [
            ['avatar-1.jpg', 'Ajay Soukal', 'Founder & Creative Director', 'The vision and heritage sensibility behind every Rajwada celebration.'],
            ['avatar-2.jpg', 'Head of Operations', '', 'Oversees venues, vendors and on-ground execution so every celebration runs without a hitch.'],
            ['avatar-3.jpg', 'Lead Wedding Planner', '', "Turns every couple's brief into a day-by-day plan, from the first Mehendi to the final Reception."],
        ];
        foreach ($team as $i => [$photo, $name, $role, $desc]) {
            TeamMember::create([
                'photo' => "site/team/{$photo}",
                'name' => $name,
                'role' => $role,
                'description' => $desc,
                'sort_order' => $i,
                'is_active' => true,
            ]);
        }

        Ceremony::query()->delete();
        $ceremonies = [
            ['icon-mehendi.png', 'Royal Touch Mehendi Ceremony', 'Handpicked artists and palace-inspired décor turn the Mehendi into a vibrant, joyful opening act.'],
            ['icon-makeup.png', 'Sacred Haldi Ceremony', 'A warm, sunlit celebration styled with marigold and tradition, honouring this sacred ritual.'],
            ['icon-choreographer.png', 'Royal Sangeet Night', 'Choreographed performances, curated music and stage design for an unforgettable night of dance.'],
            ['icon-dhol.png', 'Rajwada Sehra Bandi', "The groom's turban-tying ceremony, staged with dhol beats and royal fanfare before the Baraat."],
            ['icon-barat.png', "Maharaja's Baraat Procession", 'A grand entrance fit for royalty — horses, drummers and a procession styled to remember.'],
            ['icon-favours.png', 'Jai Mala Ceremony', 'The garland exchange staged as a beautiful, camera-ready centrepiece for family and guests.'],
            ['icon-panditji.png', 'Mangal Pheras', 'The sacred seven vows around the holy fire, conducted with our trusted panditji and full ritual care.'],
            ['icon-planning.png', 'Royal Reception', 'A glittering grand finale — curated décor, dining and entertainment to close the celebration in style.'],
        ];
        foreach ($ceremonies as $i => [$icon, $title, $desc]) {
            Ceremony::create([
                'icon' => "site/services/{$icon}",
                'title' => $title,
                'description' => $desc,
                'sort_order' => $i,
                'is_active' => true,
            ]);
        }
    }
}
