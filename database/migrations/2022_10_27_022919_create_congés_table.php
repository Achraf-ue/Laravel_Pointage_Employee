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
        Schema::create('congés', function (Blueprint $table) {
            $table->id();
            $table->integer('Id_Employee');
            $table->string('Nom_Employee');
            $table->date('Date_Debut');
            $table->date('Date_Fin');
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
        Schema::dropIfExists('congés');
    }
};
