<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantillaHorariosHoraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantilla_horarios_hora', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('plantilla_horario_id');
            $table->uuid('hora_id');
            $table->timestamps();

            $table->foreign('plantilla_horario_id')
                    ->references('id')
                    ->on('plantilla_horarios')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            
            $table->foreign('hora_id')
                    ->references('id')
                    ->on('horas')
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
        Schema::dropIfExists('plantilla_horarios_hora');
    }
}
