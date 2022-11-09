<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     *
     * @throws Exception
     */
    public function run(): void
    {
        $categories = [];

        $cName = 'Без категории';
        $createdAt = fake()->dateTimeBetween('-4 months', '-4 days');
        $categories[] = [
            'title' => $cName,
            'slug' => Str::slug($cName),
            'parent_id' => 0,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];

        for ($i = 1; $i <= 10; $i++) {
            $createdAt = fake()->dateTimeBetween('-4 months', '-4 days');
            $cName = 'Категория #'.$i;
            $parentId = ($i > 4) ? random_int(1, 4) : 1;

            $categories[] = [
                'title' => $cName,
                'slug' => Str::slug($cName),
                'parent_id' => $parentId,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        }

        DB::table('blog_categories')->insert($categories);
    }
}
