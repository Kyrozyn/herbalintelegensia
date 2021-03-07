<?php

namespace Database\Factories;

use App\Models\pelanggan;
use App\Models\pemesanan;
use App\Models\produk;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class pemesananFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = pemesanan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $produk = produk::all()->toArray();
        $produk_rand = array_rand($produk);
        $pelanggan = pelanggan::all()->toArray();
        $pelanggan_rand = array_rand($pelanggan);
        return [
            'produk_id' => $produk[$produk_rand]['id'],
            'pelanggan_id' => $pelanggan[$pelanggan_rand]['id'],
            'tanggal_pemesanan' => $this->faker->dateTimeBetween('-3 days','+2 days'),
            'keterangan' => $this->faker->sentence,
            'jumlah' => $this->faker->numberBetween(1,5),
            'status' => 'Belum Dikirim',
            'user_id' => 1,
        ];
    }
}
