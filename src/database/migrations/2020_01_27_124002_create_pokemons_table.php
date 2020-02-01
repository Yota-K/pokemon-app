<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePokemonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pokemons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pokemon_name', 10);
            $table->string('first_type', 10);
            $table->string('second_type', 10)->nullable();
            $table->string('characteristic', 10);
            $table->string('personality', 10);
            $table->string('belongings', 15);
            $table->bigInteger('user_id');
            $table->bigInteger('theory_id');
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
        Schema::dropIfExists('pokemons');
    }
}
