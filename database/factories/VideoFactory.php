<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    protected $model = Video::class;

    public function definition()
    {
        return [
            'url' => $this->faker->url,
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'user_id' => User::factory(),
            'videoable_type' => 'App\\Models\\Challenge',
            'videoable_id' => 1,
        ];
    }
}
