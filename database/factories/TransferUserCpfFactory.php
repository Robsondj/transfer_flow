<?php

namespace Database\Factories;

use App\Models\TransferUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransferUserCpfFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TransferUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'document_type' => 1,
            'document' => "{$this->faker->randomNumber(9)}{$this->faker->randomNumber(2)}",
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];
    }

}
