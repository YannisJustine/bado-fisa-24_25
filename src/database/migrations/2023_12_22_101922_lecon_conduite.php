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
        Schema::create("lecons_conduite", function (Blueprint $table) {
            $table->foreignId("lecon_id")->primary()->constrained()->onDelete("cascade");
            $table->string("plaque_imm");
            $table->foreignId("formule_conduite_id")->nullable()->constrained("formules_conduite", "formule_id")->onDelete("cascade");
            $table->foreign("plaque_imm")->references("plaque_imm")->on("vehicules")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("lecons_conduite");
    }
};
