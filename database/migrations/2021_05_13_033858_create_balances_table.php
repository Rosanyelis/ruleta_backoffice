<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /** Tabla que solo se le ingresaran datos 
         * cuando tenga tickets generados indiferentemente 
         * su estatus. */
        
        Schema::create('balances', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('responsable_id');
            $table->uuid('cliente_id');
            $table->uuid('taquilla_id');
            $table->uuid('ticket_id');
            $table->datetime('fecha_hora');
            $table->timestamps();

            $table->foreign('responsable_id')->references('id')->on('responsables')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('taquilla_id')->references('id')->on('taquillas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('ticket_id')->references('id')->on('tickets')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('balances');
    }
}
