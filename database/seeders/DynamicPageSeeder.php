<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DynamicPage;
use Illuminate\Support\Str;

class DynamicPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => 'About Us',
                'slug' => Str::slug('About Us'),
                'content' => 'This is the About Us page content.',
                'status' => 'published', // valid status
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => Str::slug('Privacy Policy'),
                'content' => 'This is the Privacy Policy page content.',
                'status' => 'published', // valid status
            ],
            [
                'title' => 'Terms & Conditions',
                'slug' => Str::slug('Terms & Conditions'),
                'content' => 'This is the Terms & Conditions page content.',
                'status' => 'draft', // valid status
            ],
        ];

        foreach ($pages as $page) {
            DynamicPage::firstOrCreate(
                ['slug' => $page['slug']], // check by slug
                $page                       // create if not exists
            );
        }
    }
}
