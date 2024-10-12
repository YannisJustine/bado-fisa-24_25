<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formules_conduite', function (Blueprint $table) {
            $table->foreignId("formule_id")->primary()->constrained()->onDelete('cascade');
            $table->foreignId("type_permis_id")->constrained()->onDelete('cascade');
            $table->integer('age_minimum')->nullable();
            $table->integer('age_maximum')->nullable();
            $table->integer('nb_heures_conduite');
            $table->integer('nb_heures_pedagogique')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formules_conduite');
    }
};
