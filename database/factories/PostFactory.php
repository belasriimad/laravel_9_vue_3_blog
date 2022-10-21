<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->sentence();
        return [
            //
            'title_fr' => $title. '_fr',
            'title_en' => $title. '_en',
            'slug' => Str::slug($title),
            'body_fr' => fake()->paragraph(). '_fr',
            'body_en' => fake()->paragraph(). '_en',
            'photo' => fake()->imageUrl(1040, 680),
            'category_id' => fake()->numberBetween(1, 10),
            'admin_id' => 1,
        ];
    }
}
