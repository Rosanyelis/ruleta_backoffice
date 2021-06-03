<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            
            $table->foreign('responsable_id')
                    ->references('id')
                    ->on('responsables')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('cliente_id')
                    ->references('id')
                    ->on('clientes')
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
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropForeign('usuarios_responsable_id_foreign');
            $table->dropForeign('usuarios_cliente_id_foreign');
            $table->dropForeign('usuarios_taquilla_id_foreign');
        });
    }
}
