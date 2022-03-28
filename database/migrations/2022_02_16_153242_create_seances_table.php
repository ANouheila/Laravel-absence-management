<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seances', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('date_seance');
            $table->string('type_seance');
            $table->string('intitule');
            $table->String('niveau');
            $table->String('filiere');
            $table->String('section');
    //     $table->integer('professeur_id')->unsigned();
    //     $table->foreign('professeur_id')->references('id')->on('professeurs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seances');
    }
}
