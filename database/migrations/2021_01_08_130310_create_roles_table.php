<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });
        DB::table('roles')->insert(
            [
                ['id'=>1,'nama'=>'Administrator'],
                ['id'=>2,'nama'=>'Sales Operational Manager'],
                ['id'=>3,'nama'=>'Staff Warehouse'],
                ['id'=>4,'nama'=>'General Manager'],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
