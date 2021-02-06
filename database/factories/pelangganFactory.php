<?php

namespace Database\Factories;

use App\Models\pelanggan;
use Illuminate\Database\Eloquent\Factories\Factory;

class pelangganFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = pelanggan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_pelanggan' => $this->faker->unique()->name,
            'alamat' => $this->faker->address,
            'lat' => $this->faker->latitude,
            'long' => $this->faker->longitude,
            'no_telp' => $this->faker->unique()->phoneNumber,
        ];
    }
}
