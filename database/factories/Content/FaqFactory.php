<?php

namespace Database\Factories\Content;

use App\Models\Content\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaqFactory extends Factory
{
    protected $model = Faq::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question'=>$this->faker->title,
            'answer'=>$this->faker->text(20),
            'tags'=>$this->faker->name,
//            'slug'=>$this->faker->name,
        ];
    }
}
