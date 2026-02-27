<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->string('SKU')->unique();
            $table->string('item_number', 100)->nullable();
            $table->longText('description')->nullable();
            $table->foreignId('category_id')->constrained('category')->onDelete('cascade');
            $table->string('image')->nullable();
            $table->boolean('out_of_stock')->default(false);
            $table->integer('quantity')->default(0);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
