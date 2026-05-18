<?php

namespace Database\Seeders;

use App\Models\SchoolSettings;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        SchoolSettings::create([
            'logo' => 'default.png',
            'name' => 'Belum di set',
            'description' => 'Belum di set',
            'status' => 'negeri',
            'akreditasi' => 'Belum di set',
            'profile_video' => 'Belum di set',
            'location' => 'Belum di set',
            'telephone' => 'Belum di set',
            'email' => 'Belum di set',

            'instagram_url' => 'Belum di set',
            'facebook_url' => 'Belum di set',
            'tiktok_url' => 'Belum di set',
            'youtube_url' => 'Belum di set',
        ]);
        $this->call([
            UserSeeder::class,
            PostCategoriesSeeder::class
        ]);
    }
}
