<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
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

         $title = $faker->unique()->productName;
        return [
            //
            'category_id'=>Category::inRandomOrder()->value('id'),
            'store_id'=>Store::inRandomOrder()->value('id'),
            'title'=>$title,
            'slug'=>Str::slug($title),
            'description'=>$this->faker->sentence(15),
            'quantity'=>$this->faker->randomNumber(2,true),
            'price'=>$this->faker->randomFloat(2,1,499),
            'compare_price'=>$this->faker->randomFloat(2,500,999),
            'product_image'=>$this->faker->imageUrl(400,400),

        ];
    }
}
