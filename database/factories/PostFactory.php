<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     * Can run this in tinker
     * App\Model\Post::factory()->times(200)->create(['user_id' => 1]);
     * 
     * @return array
     */
    public function definition()
    {
        return [
            'body' => $this->faker->sentence(20),
        ];
    }
}
