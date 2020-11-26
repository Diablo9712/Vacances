<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrioritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('priorites', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_Ville')->unsigned()->index();
            $table->bigInteger('id_Reservation')->unsigned()->index();
            $table->bigInteger('classement')->unsigned();
            $table->date('date_debut');
            $table->date('date_fin');
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
        Schema::dropIfExists('priorites');
    }
}
