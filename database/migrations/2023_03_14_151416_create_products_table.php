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
            $table->double('price', 6, 2);
            $table->enum('category', array('Spice Set', 'Snack Dish',
            'Dishes', 'Tea Glasses',
            'Teapot', 'Cooker', 'Pressure Cooker',
            'Table Cloth', 'Tea Glass', 'Cultery Set',
            'Spoon Holder','Decorative','Nut Pot','Kitchenware','Cake Pot','Tray',
            'Coffee Set','Square Plate','Kitchen Accessorie','Sport'));
            $table->longText('description');
            $table->string('SKU');
            $table->string('item_number', 100)->nullable();
            $table->string('image');
            $table->integer('quantity')->default(100);;

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
