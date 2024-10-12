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
        Schema::create('lecons', function (Blueprint $table) {
            $table->id();
            $table->date("date_reservation");
            $table->time("heure_debut");
            $table->time("heure_fin");
            $table->unsignedInteger("essais")->default(0);
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->foreignId("candidat_id")->constrained()->onDelete("cascade");
            $table->foreignId("statut_id")->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::dropIfExists("lecons");
    }
};
