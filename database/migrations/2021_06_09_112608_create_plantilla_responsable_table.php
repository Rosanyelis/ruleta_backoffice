<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantillaResponsableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantilla_responsable', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('responsable_id');
            $table->string('nombre');
            $table->uuid('plantilla_ruleta_id');
            $table->uuid('plantilla_jugada_id');
            $table->uuid('plantilla_horario_id');
            $table->timestamps();

            $table->foreign('responsable_id')
                    ->references('id')
                    ->on('responsables')
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
        Schema::dropIfExists('plantilla_responsable');
    }
}
