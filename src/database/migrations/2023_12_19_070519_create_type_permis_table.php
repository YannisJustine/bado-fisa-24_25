<?php

use App\Enums\TypePermisEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    protected $casts = [
        'libelle' => TypePermisEnum::class
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('type_permis', function (Blueprint $table) {
            $table->id();
            $table->string('libelle')->unique();
            $table->double("prix_unitaire");
            $table->integer("age_minimum_requis");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_permis');
    }
};
