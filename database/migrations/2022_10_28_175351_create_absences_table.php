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
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->integer('Id_Employee');
            $table->integer('Id_Departement');
            $table->string('Nom_Employee');
            $table->string('Cin');
            $table->date('Date_Debut');
            $table->date('Date_Fin');
            $table->string('Motif');
            $table->string('Motif_Fichier');
            $table->string('Read_at');
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
        Schema::dropIfExists('absences');
    }
};
