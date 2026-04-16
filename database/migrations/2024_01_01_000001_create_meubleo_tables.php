<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meubleo_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('meubleo_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('meubleo_categories')->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('details')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->unsignedInteger('stock')->default(0);
            $table->string('sku')->unique();
            $table->string('material')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('color')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('meubleo_product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('meubleo_products')->cascadeOnDelete();
            $table->string('path');
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });

        Schema::create('meubleo_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('order_number')->unique();
            $table->enum('status', ['pending','paid','processing','shipped','delivered','cancelled'])->default('pending');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('shipping', 10, 2)->default(0);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->string('payment_method')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('shipping_name');
            $table->string('shipping_address');
            $table->string('shipping_city');
            $table->string('shipping_postal_code');
            $table->string('shipping_country')->default('France');
            $table->string('shipping_phone')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('meubleo_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('meubleo_orders')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('meubleo_products')->cascadeOnDelete();
            $table->string('product_name');
            $table->unsignedInteger('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
        });

        Schema::create('meubleo_cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('session_id')->nullable();
            $table->foreignId('product_id')->constrained('meubleo_products')->cascadeOnDelete();
            $table->unsignedInteger('quantity')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meubleo_cart_items');
        Schema::dropIfExists('meubleo_order_items');
        Schema::dropIfExists('meubleo_orders');
        Schema::dropIfExists('meubleo_product_images');
        Schema::dropIfExists('meubleo_products');
        Schema::dropIfExists('meubleo_categories');
    }
};
