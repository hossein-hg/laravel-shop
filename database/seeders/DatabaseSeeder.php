<?php

namespace Database\Seeders;

use App\Models\Content\Faq;
use App\Models\Content\Page;
use App\Models\Content\PostCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
//         PostCategory::factory(30)->create();
//         Faq::factory(5)->create();
         Page::factory(5)->create();
    }
}
