<?php

namespace Database\Factories;


use App\Models\User_contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class User_contactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User_contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'c_email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'social' => 'a::::https://w.w;;;;a::::https://w.w',
            'website' => 'a::::https://w.w;;;;a::::https://w.w',
            'user_id' => 'user_id',

        ];
    }
}
?>
