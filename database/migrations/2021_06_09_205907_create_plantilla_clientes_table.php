<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantillaClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantilla_clientes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('cliente_id');
            $table->string('nombre');
            $table->uuid('plantilla_ruleta_id');
            $table->uuid('plantilla_jugada_id');
            $table->uuid('plantilla_horario_id');
            $table->timestamps();

            $table->foreign('cliente_id')
                    ->references('id')
                    ->on('clientes')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('plantilla_ruleta_id')
                    ->references('id')
                    ->on('plantilla_ruletas')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('plantilla_jugada_id')
                    ->references('id')
                    ->on('plantilla_jugadas')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('plantilla_horario_id')
                    ->references('id')
                    ->on('plantilla_horarios')
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
        Schema::dropIfExists('plantilla_clientes');
    }
}
