<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends Factory<Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         $faker = \Faker\Factory::create();
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
         $name = $faker->unique()->department;
        return [
            //
            'name'=>$name,
            'slug'=>Str::slug($name),
            'description'=>$this->faker->sentence(10),
            'logo_image'=>$this->faker->imageUrl(300,200),
            'cover_image'=>$this->faker->imageUrl(600,400),
        ];
    }
}
