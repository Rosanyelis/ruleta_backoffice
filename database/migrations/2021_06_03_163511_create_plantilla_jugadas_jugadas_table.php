<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantillaJugadasJugadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantilla_jugadas_jugadas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('plantilla_jugada_id');
            $table->uuid('jugada_id');
            $table->timestamps();

            $table->foreign('plantilla_jugada_id')
                    ->references('id')
                    ->on('plantilla_jugadas')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            
            $table->foreign('jugada_id')
                    ->references('id')
                    ->on('jugadas')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plantilla_jugadas_jugadas');
    }
}
