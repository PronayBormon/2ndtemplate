<?php

namespace Database\Seeders;

use App\Models\SystemSetting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SystemSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SystemSetting::updateOrCreate(
            ['id' => '1'],
            [
                'site_name'        => 'My Website',
                'contact_email'    => 'info@example.com',
                'contact_phone'    => '+123456789',
                'address'          => '123 Street, City, Country',
                'meta_title'       => 'Welcome to My Website',
                'meta_description' => 'This is my website description for SEO.',
                'meta_keywords'    => 'laravel, website, seo, system settings',
                'og_title'         => 'My Website OpenGraph Title',
                'og_description'   => 'This is an OpenGraph description for social sharing.',
            ]
        );
    }
}
