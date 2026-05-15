<?php

namespace Database\Seeders;

use App\Models\PostCategories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostCategories::insert([
            [
                'name' => 'Kategori 1',
                'slug' => 'kategori-1',
            ],
            [
                'name' => 'Kategori 2',
                'slug' => 'kategori-2',
            ]
        ]); 
    }
}
