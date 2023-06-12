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
        Schema::create('livraisons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vente')->index();
            $table->enum('etat',['Livrée','En cours de livraison','Livraison prévue'])->default('Livraison prévue');
            $table->string('adresse')->default('Dépot');
            $table->timestamps();

            $table->foreign('vente')->references('id')->on('ventes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livraisons');
    }
};
