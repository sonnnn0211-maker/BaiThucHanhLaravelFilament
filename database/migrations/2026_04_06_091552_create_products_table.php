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
        Schema::create('23810310424_products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                ->constrained('23810310424_categories')
                ->cascadeOnDelete();

            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            $table->decimal('price', 10, 2);
            $table->integer('stock_quantity');

            $table->string('image_path')->nullable();

            $table->enum('status', [
                'draft',
                'published',
                'out_of_stock'
            ]);

            // ⭐ FIELD SÁNG TẠO
            $table->integer('discount_percent')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('23810310424_products');
    }
};