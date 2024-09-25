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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('barcode')->unique();
            $table->string('sku')->unique();
            $table->string('car_model');
            $table->string('car_year');
            $table->string('car_color');
            $table->string('car_scale');
            $table->string('car_attribute');
            $table->integer('stock');
            $table->json('images')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('price_normal', 10, 2);
            $table->decimal('price_sale', 10, 2);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->boolean('in_stock')->default(true);
            $table->boolean('on_sale')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
