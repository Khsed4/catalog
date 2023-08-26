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
            $table->timestamps();
            $table->string('name');
            $table->unsignedBigInteger('category_id')->unsigned();
            $table->unsignedBigInteger('cataloge_id')->unsigned();
            $table->double('price', 6, 2);
            $table->longText('description');
            $table->string('SKU');
            $table->string('item_number', 100)->nullable();
            $table->string('image');
            $table->integer('out_of_stock')->default(1);
            $table->integer('quantity')->default(0);
            $table->foreign('category_id')->references('id')->on('Category')
                ->onDelete('cascade');
            $table->foreign('cataloge_id')->references('id')->on('Cataloge')
                ->onDelete('cascade');
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
