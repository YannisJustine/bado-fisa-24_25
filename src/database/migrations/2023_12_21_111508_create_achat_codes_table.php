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
        Schema::create('achat_code', function (Blueprint $table) {
            $table->foreignId("formule_code_id")->constrained("formules_code", "formule_id")->onDelete("cascade");
            $table->foreignId("candidat_id")->constrained()->onDelete("cascade");
            $table->dateTime("date_achat");
            $table->date("date_debut");
            $table->date("date_fin")->nullable();
            $table->timestamps();
            $table->primary(["formule_code_id","candidat_id","date_achat"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achat_code');
    }
};
