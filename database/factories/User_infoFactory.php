<?php

namespace Database\Factories;


use App\Models\User_info;
use Illuminate\Database\Eloquent\Factories\Factory;

class User_infoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User_info::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'img' => $this->faker->word(),
            'd_name' => $this->faker->userName(),
            'location' => $this->faker->city,
            'bio' => $this->faker->sentence,
            'dark_mode' => 1,
            'bg_img' => $this->faker->word,
        ];
    }
}
?>
