<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      
    static $faker = null;

    if ($faker === null) {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
    }

    $name = $faker->unique()->category;

        return [
            //
            'name'=>ucfirst($name),
           'slug' => Str::slug($name ),
            'description'=>$this->faker->sentence(10),
            'image'=>$this->faker->imageUrl(300,200),
        ];
    }
}
