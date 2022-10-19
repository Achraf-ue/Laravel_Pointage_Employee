<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deparetements', function (Blueprint $table) {
            $table->id();
            $table->string('Deparetement_Nom')->unique();
            $table->time('Date_Debut');
            $table->time('Date_Fin');
            $table->timestamps();
        });
        /*Schema::table('deparetements', function (Blueprint $table) {
            $table->time('Date_Debut')->change();
            $table->time('Date_fin')->change();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deparetements');
    }
};
