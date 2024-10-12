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
        Schema::create('achat_formule_conduite', function (Blueprint $table) {
            $table->foreignId("formule_conduite_id")->constrained("formules_conduite", "formule_id")->onDelete("cascade");
            $table->foreignId("candidat_id")->constrained()->onDelete("cascade");
            $table->dateTime("date_achat");
            $table->timestamps();
            $table->primary(["formule_conduite_id","candidat_id","date_achat"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achat_formule_conduite');
    }
};
