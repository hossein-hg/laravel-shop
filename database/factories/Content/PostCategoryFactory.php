<?php

namespace Database\Factories\Content;

use App\Models\Content\PostCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostCategoryFactory extends Factory
{
    protected $model = PostCategory::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'name'=>$this->faker->colorName,
            'slug'=>'کالا-الکتریکی'.rand(10,1000),
            'description'=>$this->faker->text,
            'image'=>$this->faker->image(),
            'tags'=>$this->faker->companySuffix,
        ];
    }
}
