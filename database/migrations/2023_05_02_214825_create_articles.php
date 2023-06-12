<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->bigInteger('code')->nullable();
            $table->date('date_de_peremption');
            $table->integer('stock');
            $table->integer('stock_min')->nullable();
            $table->string('image')->default('med.png');
            $table->double('prix');
            $table->string('utilisation')->nullable();
            $table->enum('type',['Médicament','Matériel','Espace Bébé'])->default('Médicament');
            $table->longText('description')->nullable();
            $table->String('forme')->nullable();
            $table->String('age')->nullable();
            $table->String('enceinte')->nullable();
            $table->String('allaitement')->nullable();
            $table->longText('notice')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};