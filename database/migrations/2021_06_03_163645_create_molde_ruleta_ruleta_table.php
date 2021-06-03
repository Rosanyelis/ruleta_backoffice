<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoldeRuletaRuletaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('molde_ruleta_ruleta', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('molde_id');
            $table->uuid('ruleta_id');
            $table->timestamps();

            $table->foreign('molde_id')
                    ->references('id')
                    ->on('molde_ruletas')
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
        Schema::dropIfExists('molde_ruleta_ruleta');
    }
}
