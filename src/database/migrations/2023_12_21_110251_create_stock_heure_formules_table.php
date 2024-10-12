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
        Schema::create('stock_heures_formule', function (Blueprint $table) {
            $table->foreignId("candidat_id")->constrained()->onDelete("cascade");
            $table->foreignId("formule_conduite_id")->constrained("formules_conduite", "formule_id")->onDelete("cascade");
            $table->integer("quantite_conduite_restante")->unsigned();
            $table->integer("quantite_pedagogique_restante")->unsigned();
            $table->timestamps();
            $table->primary(["candidat_id","formule_conduite_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_heures_formule');
    }
};
