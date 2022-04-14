<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserPicture>
 */
class UserPictureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'picture' => $this->faker->image('storage/app/public/pictures/61'),
            'small_picture' => $this->faker->image('storage/app/public/pictures/61'),
        ];
    }
}
