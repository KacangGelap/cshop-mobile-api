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
        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->timestamps();
        });
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('product');
            $table->string('description');
            $table->foreignId('category_id')->constrained(
                table: 'category', indexName: 'category_product_id'
            );
            $table->integer('stock');
            $table->integer('price');
            $table->longText('image')->charset('binary')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
