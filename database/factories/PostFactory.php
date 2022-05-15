<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        return [
            "user_id" => DB::table('users')->select('id')->inRandomOrder()->first()->id,
            "title" => $this->faker->sentence(4, 7),
            "post_image" => $this->faker->imageUrl(900, 300),
            "body" => $this->faker->paragraphs(4, 15),
        ];
    }
}