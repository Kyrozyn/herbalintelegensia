<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoristoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historistoks', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal_waktu')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('perubahan');
            $table->integer('jumlah_stok');
            $table->unsignedBigInteger('produk_id');
            $table->foreign('produk_id')->references('id')->on('produks')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historistoks');
    }
}
