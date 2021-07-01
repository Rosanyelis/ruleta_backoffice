<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_tickets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('ticket_id');
            $table->uuid('ruleta_id');
            $table->uuid('hora_id');
            $table->uuid('jugada_id');
            $table->decimal('monto_jugado', 20, 2);
            $table->decimal('monto_pagar', 20, 2);
            $table->timestamps();

            $table->foreign('ticket_id')
                    ->references('id')
                    ->on('tickets')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('ruleta_id')
                    ->references('id')
                    ->on('ruletas')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('hora_id')
                    ->references('id')
                    ->on('horas')
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
        Schema::dropIfExists('detalle_tickets');
    }
}
