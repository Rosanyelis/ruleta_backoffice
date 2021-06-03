<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJugadaMoldeJugadaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jugada_molde_jugada', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('molde_id');
            $table->uuid('jugada_id');
            $table->timestamps();

            $table->foreign('molde_id')
                    ->references('id')
                    ->on('molde_jugadas')
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
        Schema::dropIfExists('jugada_molde_jugada');
    }
}
