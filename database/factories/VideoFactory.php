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
            'user_id' => User::factory(), // Asegúrate de tener una fábrica para User
            'videoable_type' => 'App\\Models\\Challenge', // O el tipo de relación que uses
            'videoable_id' => 1, // Asegúrate de que este ID exista en la tabla correspondiente
        ];
    }
}
