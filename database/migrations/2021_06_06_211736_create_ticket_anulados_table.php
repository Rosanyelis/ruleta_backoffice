<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketAnuladosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_anulados', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('ticket_id');
            $table->uuid('taquilla_id');
            $table->date('fecha');
            $table->string('motivo');
            $table->boolean('estatus');
            $table->timestamps();

            $table->foreign('ticket_id')
                    ->references('id')
                    ->on('tickets')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('taquilla_id')
                    ->references('id')
                    ->on('taquillas')
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
        Schema::dropIfExists('ticket_anulados');
    }
}
