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
        Schema::create('habilite', function (Blueprint $table) {
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->foreignId("type_permis_id")->constrained()->onDelete("cascade");
            $table->timestamps();
            $table->primary(["user_id","type_permis_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habilite');
    }
};
