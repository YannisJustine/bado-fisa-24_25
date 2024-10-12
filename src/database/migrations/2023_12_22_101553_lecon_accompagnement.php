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
        Schema::create('lecons_accompagnement', function (Blueprint $table) {
            $table->foreignId("lecon_id")->primary()->constrained()->onDelete("cascade");
            $table->foreignId("formule_conduite_id")->constrained("formules_conduite", "formule_id")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("lecons_accompagnement");
    }
};
