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
        Schema::create('achat_heures_supps', function (Blueprint $table) {
            $table->foreignId("candidat_id")->constrained()->onDelete("cascade");
            $table->foreignId("type_permis_id")->constrained()->onDelete("cascade");
            $table->dateTime("date_achat");
            $table->integer("quantite")->unsigned();
            $table->timestamps();
            $table->primary(["candidat_id","type_permis_id","date_achat"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achat_heures_supps');
    }
};
