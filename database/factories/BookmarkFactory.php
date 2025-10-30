<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Bookmark;
use App\Models\Category;
use App\Models\User;

class BookmarkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bookmark::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'url' => fake()->url(),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
