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
        Schema::create('vente_articles', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('vente')->index();
            $table->unsignedBigInteger('article')->index();
            $table->integer('quantite');
            $table->timestamps();

            $table->foreign('vente')->references('id')->on('ventes')->onDelete('cascade');
            $table->foreign('article')->references('id')->on('articles');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vente_articles');
    }
};
