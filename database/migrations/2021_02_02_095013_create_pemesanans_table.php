<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('pelanggan_id');
            $table->dateTime('tanggal_pemesanan');
            $table->string('keterangan');
            $table->integer('jumlah');
            $table->enum('status',['Dikirim','Belum Dikirim']);
            $table->unsignedBigInteger('user_id');
            //foreign key
            $table->foreign('produk_id')->references('id')->on('produks')->cascadeOnDelete();
            $table->foreign('pelanggan_id')->references('id')->on('pelanggans')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemesanans');
    }
}
