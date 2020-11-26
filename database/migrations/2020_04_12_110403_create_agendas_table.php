<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
//            $table->bigInteger('id_reservation')->unsigned()->index();
            $table->bigInteger('id_centre')->unsigned()->index();
            $table->bigInteger('id_priorite')->unsigned()->index();
            // $table->bigInteger('id_etat_centre')->unsigned()->index();
//            $table->foreign('id_reservation')
//                ->references('id')
//                ->on('reservations')
//                ->onDelete('cascade');

            $table->foreign('id_centre')
                ->references('id')
                ->on('centres')
                ->onDelete('cascade');


            $table->foreign('id_priorite')
                ->references('id')
                ->on('priorites')
                ->onDelete('cascade');

            //$table->foreign('id_etat_centre')
                //->references('id')
                //->on('etat_centres')
                //->onDelete('cascade');
            $table->double('montant_reservation');
            $table->double('montant_penalite');
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
        Schema::dropIfExists('agendas');
    }
}
