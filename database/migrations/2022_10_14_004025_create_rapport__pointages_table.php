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
        Schema::create('rapport__pointages', function (Blueprint $table) {
            $table->id();
            $table->integer('Id_Employee');
            $table->integer('Id_Retard')->nullable();
            $table->date('Date_Jour');
            $table->dateTime('Date_Entre')->nullable();
            $table->dateTime('Date_Sortir')->nullable(); 
            $table->string('Nom_Employee');
            $table->integer('Temp_Traville');
            $table->integer('Temp_Traville_supplementaire')->nullable();
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
        Schema::dropIfExists('rapport__pointages');
    }
};
