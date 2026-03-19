<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['Test Cricket', 'ODI', 'T20', 'IPL', 'World Cup', 'Players', 'Teams', 'Global'];
        $title = fake()->sentence(rand(5, 10));

        return [
            'title' => rtrim($title, '.'),
            'slug' => Str::slug($title),
            'excerpt' => fake()->sentence(rand(15, 25)),
            'content' => fake()->paragraphs(rand(5, 10), true),
            'category' => fake()->randomElement($categories),
            'image_url' => 'images/dummy/news-' . rand(1, 10) . '.jpg',
            'author' => fake()->name(),
            'published_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
