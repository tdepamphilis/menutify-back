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
        Schema::create('provincias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        

        DB::table('provincias')->insert(['nombre' => 'Buenos Aires']);
        DB::table('provincias')->insert(['nombre' => 'Ciudad de Buenos Aires']);
        DB::table('provincias')->insert(['nombre' => 'Catamarca']);
        DB::table('provincias')->insert(['nombre' => 'Chaco']);
        DB::table('provincias')->insert(['nombre' => 'Chubut']);
        DB::table('provincias')->insert(['nombre' => 'Córdoba']);
        DB::table('provincias')->insert(['nombre' => 'Corrientes']);
        DB::table('provincias')->insert(['nombre' => 'Entre Ríos']);
        DB::table('provincias')->insert(['nombre' => 'Formosa']);
        DB::table('provincias')->insert(['nombre' => 'Jujuy']);
        DB::table('provincias')->insert(['nombre' => 'La Pampa']);
        DB::table('provincias')->insert(['nombre' => 'La Rioja']);
        DB::table('provincias')->insert(['nombre' => 'Mendoza']);
        DB::table('provincias')->insert(['nombre' => 'Misiones']);
        DB::table('provincias')->insert(['nombre' => 'Neuquén']);
        DB::table('provincias')->insert(['nombre' => 'Río Negro']);
        DB::table('provincias')->insert(['nombre' => 'Salta']);
        DB::table('provincias')->insert(['nombre' => 'San Juan']);
        DB::table('provincias')->insert(['nombre' => 'San Luis']);
        DB::table('provincias')->insert(['nombre' => 'Santa Fe']);
        DB::table('provincias')->insert(['nombre' => 'Santiago del Estero']);
        DB::table('provincias')->insert(['nombre' => 'Tierra del Fuego']);
        DB::table('provincias')->insert(['nombre' => 'Tucumán']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provincias');
    }
};
