<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         \App\Models\User::factory(10)->create();
         \App\Models\produk::factory(50)->create();
         \App\Models\pelanggan::factory(50)->create();
         \App\Models\pemesanan::factory(10)->create();
    }
}
