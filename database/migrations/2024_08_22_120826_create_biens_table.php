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
        Schema::create('biens', function (Blueprint $table) {
            $table->id();
            $table->integer('chambre');
            $table->string('commune');
            $table->string('quartier');
            $table->string('avenue');
            $table->integer('numero');
            $table->string('description');
            $table->integer('loyer');
            $table->integer('garantie');
            $table->integer('prix_vente');
            $table->double('surface');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biens');
    }
};
