<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\produk;
use Illuminate\Database\Eloquent\Factories\Factory;

class produkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = produk::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->unique()->firstName,
            'deskripsi' => $this->faker->sentence,
            'jumlah_stok' => $this->faker->numberBetween(10,20),
        ];
    }
}
