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
        Schema::create('inscrit_cours_code', function (Blueprint $table) {
            $table->foreignId("candidat_id")->constrained()->onDelete("cascade");
            $table->foreignId("cours_code_id")->constrained("cours_code")->onDelete("cascade");
            $table->timestamps();
            $table->primary(["candidat_id","cours_code_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscrit_cours_code');
    }
};
