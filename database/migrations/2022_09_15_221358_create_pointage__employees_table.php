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
        Schema::create('pointage__employees', function (Blueprint $table) {
            $table->id();
            $table->integer('Id_Employee');
            $table->date('Date_Jour');
            $table->dateTime('Date_Entre');
            $table->dateTime('Date_Sortir'); 
            $table->string('Type_Pointage');
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
        Schema::dropIfExists('pointage__employees');
    }
};
