<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantillaRuletasRuletasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantilla_ruletas_ruletas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('plantilla_ruleta_id');
            $table->uuid('ruleta_id');
            $table->timestamps();

            $table->foreign('plantilla_ruleta_id')
                    ->references('id')
                    ->on('plantilla_ruletas')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            
            $table->foreign('ruleta_id')
                    ->references('id')
                    ->on('ruletas')
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
        Schema::dropIfExists('plantilla_ruletas_ruletas');
    }
}
