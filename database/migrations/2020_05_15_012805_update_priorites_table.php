<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePrioritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('priorites', function (Blueprint $table) {
            $table->foreign('id_Ville')
                ->references('id')
                ->on('centres')
                ->onDelete('cascade');
            $table->foreign('id_Reservation')
                ->references('id')
                ->on('reservations')
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
        //
    }
}
