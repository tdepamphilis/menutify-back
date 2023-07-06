<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caracteristicas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('icon');
            $table->timestamps();
        });

        Schema::create('caracteristica_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('caracteristica_id');
            $table->timestamps();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('caracteristica_id')->references('id')->on('caracteristicas')->onDelete('cascade');
        });

        DB::table('caracteristicas')->insert(['nombre' => 'vegetariano', 'icon' => 'null']);
        DB::table('caracteristicas')->insert(['nombre' => 'vegano', 'icon' => 'null']);
        DB::table('caracteristicas')->insert(['nombre' => 'picante', 'icon' => 'null']);
        DB::table('caracteristicas')->insert(['nombre' => 'sin Tacc', 'icon' => 'null']);

    }

    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caracteristica_item');
        Schema::dropIfExists('caracteristicas');
    }
};
