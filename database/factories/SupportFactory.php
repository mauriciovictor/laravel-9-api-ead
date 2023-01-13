<?php

namespace Database\Factories;

use App\Http\Resources\LessonResource;
use App\Http\Resources\UserResource;
use App\Models\Lesson;
use App\Models\Support;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Support>
 */
class SupportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Support::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'lesson_id' => Lesson::factory(),
            'status' => 'P',
            'description' => fake()->sentence(20),

        ];
    }
}
