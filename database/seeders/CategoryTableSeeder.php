<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Functions\Helper;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['HTML', 'CSS', 'JavaScript', 'PHP', 'C++'];

        foreach ($data as $category) {
            $new_category = new Category();
            $new_category->name = $category;
            $new_category->slug = Helper::generateSlug($new_category->name, Category::class);
            $new_category->save();
        }
    }
}
