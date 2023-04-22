<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->words(2, true),
            'slug' => $this->faker->unique()->slug(4),
            'description' => $this->faker->paragraph(1),
            'content' => $this->faker->paragraph(1),
            'category_id' => $this->faker->numberBetween(1, 4),
            'views' => $this->faker->numberBetween(10, 100),
            'thumbnail' => 'images/2023-04-07/Y09l3HVkux4OfxcQEUDr1gf7DdnJToP8ZgHUtBc2.png',
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
