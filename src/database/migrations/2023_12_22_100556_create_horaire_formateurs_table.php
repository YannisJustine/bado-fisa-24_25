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
        Schema::create('horaires_formateur', function (Blueprint $table) {
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->foreignId("creneau_id")->constrained("creneaux")->onDelete("cascade");
            $table->timestamps();
            $table->primary(["user_id", "creneau_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horaire_formateurs');
    }
};
