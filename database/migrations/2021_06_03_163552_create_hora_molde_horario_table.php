<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoraMoldeHorarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hora_molde_horario', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('molde_id');
            $table->uuid('hora_id');
            $table->timestamps();

            $table->foreign('molde_id')
                    ->references('id')
                    ->on('molde_horarios')
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
        Schema::dropIfExists('hora_molde_hora');
    }
}
