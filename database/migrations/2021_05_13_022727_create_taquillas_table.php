<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaquillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taquillas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('usuario_id')->nullable();
            $table->uuid('responsable_id')->nullable();
            $table->uuid('persona_id')->nullable();
            $table->string('codigo');
            $table->string('direccion');
            $table->macAddress('direccion_mac')->nullable();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('responsable_id')->references('id')->on('responsables')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('persona_id')->references('id')->on('personas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taquillas');
    }
}
