<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->string('cod_mov',20)->unique();
            $table->date('fecha_mov');
            $table->integer('id_cli__mov');
            $table->integer('id_cta_mov');
            $table->float('monto_mov', 12, 2);
            $table->integer('id_moneda_mov');
            $table->integer('id_tasa_mov');
            $table->date('fecha_dep_mov');
            $table->string('ref_dep_mov',20);
            $table->time('h_dep_mov');
            $table->float('monto_bs_mov', 12, 2);
            $table->integer('id_estado_mov');
            $table->integer('id_user_mod');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimientos');
    }
}
