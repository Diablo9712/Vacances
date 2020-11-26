<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centres', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ville_id')->unsigned()->index();
            $table->foreign('ville_id')->references('id')
                ->on('villes')->onDelete('cascade');
            $table->string('libelle');
            $table->text('adresse')->nullable();
            $table->string('tel')->nullable();
            $table->string('assistant')->nullable();
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
        Schema::dropIfExists('centres');
    }
}
