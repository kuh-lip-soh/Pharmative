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
        Schema::create('achat_articles', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('achat')->index();
            $table->unsignedBigInteger('article')->index();
            $table->integer('quantite');
            $table->timestamps();

            $table->foreign('achat')->references('id')->on('achats');
            $table->foreign('article')->references('id')->on('articles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achat_articles');
    }
};
