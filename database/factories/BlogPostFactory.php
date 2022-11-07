<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogPost>
 */
class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->sentence(random_int(3, 8));
        $txt = fake()->realText(random_int(1000, 4000));
        $isPublished = random_int(1, 5) > 1;
        $createdAt = fake()->dateTimeBetween('-3 months', '-2 days');

        return [
            'category_id' => random_int(1, 11),
            'user_id' => (random_int(1, 5) === 5) ? 1 : 2,
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => fake()->text(random_int(40, 100)),
            'content_raw' => $txt,
            'content_html' => $txt,
            'is_published' => $isPublished,
            'published_at' => $isPublished ? fake()->dateTimeBetween('-2 months', '-1 days') : null,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }
}
