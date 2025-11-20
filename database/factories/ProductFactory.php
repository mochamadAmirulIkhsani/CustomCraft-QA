<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_produk' => fake()->words(3, true),
            'deskripsi' => fake()->paragraph(),
            'no_whatsapp' => fake()->numerify('08##########'),
            'image' => 'products/default.jpg',
            'image2' => null,
            'image3' => null,
            'image4' => null,
        ];
    }

    /**
     * Indicate that the product has all images.
     */
    public function withAllImages(): static
    {
        return $this->state(fn (array $attributes) => [
            'image' => 'products/image1.jpg',
            'image2' => 'products/image2.jpg',
            'image3' => 'products/image3.jpg',
            'image4' => 'products/image4.jpg',
        ]);
    }

    /**
     * Indicate that the product has no images.
     */
    public function withoutImages(): static
    {
        return $this->state(fn (array $attributes) => [
            'image' => null,
            'image2' => null,
            'image3' => null,
            'image4' => null,
        ]);
    }
}
