<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    use HasFactory;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title"=> $this->faker->sentence(5),
            "tags"=> "laravel,express,api",
            "company"=> $this->faker->company(),
            "location"=> $this->faker->city(),
            "email"=> $this->faker->companyEmail(),
            "website"=> $this->faker->url(),
            "description"=> $this->faker->paragraph(5),

        ];
    }
}
