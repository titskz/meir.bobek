<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use App\Models\Group;
use App\Models\Page;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KindergartenSeeder extends Seeder
{
    public function run(): void
    {
        Storage::disk('public')->makeDirectory('settings');
        Storage::disk('public')->makeDirectory('gallery');
        Storage::disk('public')->makeDirectory('groups');
        Storage::disk('public')->makeDirectory('pages');

        $logo = $this->copyAsset('files/m-logo.png', 'settings/logo.png');
        $favicon = $this->copyAsset('files/m-icon.png', 'settings/favicon.png');
        $hero = $this->copyAsset('files/WhatsApp Image 2026-09-05 at 11.38.16.jpeg', 'settings/hero.jpg');

        SiteSetting::query()->updateOrCreate([], [
            'site_name' => 'Мейіржан балабақшасы',
            'meta_keywords' => 'балабақша, Мейіржан, Алматы, садик, бала',
            'meta_description' => 'Мейіржан балабақшасы — заманауи, қауіпсіз әрі жылы орта. Балаңыздың дамуына ерекше көңіл бөлеміз.',
            'logo' => $logo,
            'favicon' => $favicon,
            'phone' => '+7 (777) 123-45-67',
            'email' => 'info@meyirzhan.kz',
            'address' => 'Алматы қ., Мейіржан ауданы',
            'whatsapp' => '77771234567',
            'instagram' => 'https://instagram.com',
            'hero_title' => 'Мейіржан балабақшасы',
            'hero_subtitle' => 'Балаңыздың болашағы — біздің мission. Жылы, қауіпсіз әрі дамуға бай орта.',
            'hero_image' => $hero,
            'manager_name' => 'Мейіржан А.',
            'manager_position' => 'Балабақша директоры',
            'manager_bio' => '<p>20 жылдық тәжірибемен балаларды дамытуға, әр балаға жеке көңіл бөлуге міндеттімін. Мейіржан балабақшасы — отбасы мен бала арасындағы сенімді көпір.</p>',
            'manager_photo' => $hero,
            'documents_iframe_url' => 'https://drive.google.com/embeddedfolderview?id=YOUR_FOLDER_ID#grid',
            'footer_text' => '© Мейіржан балабақшасы. Барлық құқықтар қорғалған.',
            'advantages' => [
                ['title' => 'Ойын арқылы даму', 'description' => 'Ойын арқылы ойлау, қиял мен қарым-қатынас дағдыларын дамытамыз.'],
                ['title' => 'Шығармашылық әлемі', 'description' => 'Сурет, музыка және қолөнер — әр бала өз талантын аша алады.'],
                ['title' => 'Мейірімге толы орта', 'description' => 'Жылы, қауіпсіз әрі мейірімді атмосфера — әр бала үшін.'],
            ],
        ]);

        Page::query()->updateOrCreate(
            ['slug' => 'about'],
            [
                'title' => 'Біз туралы',
                'content' => '<p><strong>Мейіржан балабақшасы</strong> — заманауи материалдық базасы бар, балалардың физикалық, интеллектуалдық және эмоционалдық дамуына бағытталған мекеме.</p><p>Біз әр балаға жеке көңіл бөлеміз, отбасымен тығыз ынтымақтастықта жұмыс істейміз.</p>',
                'image' => $hero,
                'meta_title' => 'Біз туралы — Мейіржан',
                'meta_description' => 'Мейіржан балабақшасы туралы толық ақпарат',
                'is_published' => true,
                'sort_order' => 1,
            ],
        );

        $groupImages = [
            'files/WhatsApp Image 2026-09-05 at 11.38.17.jpeg',
            'files/WhatsApp Image 2026-09-05 at 11.38.17 (1).jpeg',
            'files/WhatsApp Image 2026-09-05 at 11.38.17 (2).jpeg',
        ];

        $groups = [
            ['title' => 'Кішкентайлар (2-3 жас)', 'content' => '<p>Ерте даму, сезім мotorikasi, музыка мен ойын арқылы үйрену.</p>'],
            ['title' => 'Орта топ (3-4 жас)', 'content' => '<p>Логика, сөйлеу дамуы, топтық ойындар мен шығармашылық.</p>'],
            ['title' => 'Аға топ (5-6 жас)', 'content' => '<p>Мектепке дайындық, оқу дағдылары, ағылшын тілі.</p>'],
        ];

        foreach ($groups as $i => $group) {
            $image = $this->copyAsset($groupImages[$i], "groups/group-{$i}.jpg");

            Group::query()->updateOrCreate(
                ['title' => $group['title']],
                [
                    'slug' => Str::slug($group['title']) ?: "group-{$i}",
                    'content' => $group['content'],
                    'image' => $image,
                    'sort_order' => $i + 1,
                    'is_active' => true,
                ],
            );
        }

        $galleryFiles = [
            'files/WhatsApp Image 2026-09-05 at 11.38.17 (3).jpeg',
            'files/WhatsApp Image 2026-09-05 at 11.38.17 (4).jpeg',
            'files/WhatsApp Image 2026-09-05 at 11.38.17.jpeg',
            'files/WhatsApp Image 2026-09-05 at 11.38.17 (1).jpeg',
            'files/WhatsApp Image 2026-09-05 at 11.38.17 (2).jpeg',
            'files/WhatsApp Image 2026-09-05 at 11.38.16.jpeg',
        ];

        $galleryTitles = ['Алтын күз', 'Қызықты сабақтар', 'Мерекелер', 'Ойын сәттері', 'Топтар', 'Балабақша'];

        foreach ($galleryFiles as $i => $file) {
            $image = $this->copyAsset($file, "gallery/gallery-{$i}.jpg");

            GalleryItem::query()->updateOrCreate(
                ['title' => $galleryTitles[$i]],
                [
                    'image' => $image,
                    'sort_order' => $i + 1,
                    'is_active' => true,
                ],
            );
        }

        TeamMember::query()->updateOrCreate(
            ['name' => 'Мейіржан А.'],
            [
                'position' => 'Директор',
                'image' => $hero,
                'sort_order' => 1,
                'is_active' => true,
            ],
        );

        TeamMember::query()->updateOrCreate(
            ['name' => 'Айгүл С.'],
            [
                'position' => 'Аға тәрбиелеуші',
                'image' => $this->copyAsset($groupImages[1], 'team/member-2.jpg'),
                'sort_order' => 2,
                'is_active' => true,
            ],
        );
    }

    private function copyAsset(string $source, string $destination): ?string
    {
        $from = base_path($source);

        if (! File::exists($from)) {
            return null;
        }

        Storage::disk('public')->put($destination, File::get($from));

        return $destination;
    }
}
