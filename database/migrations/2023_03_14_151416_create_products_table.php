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
            $table->enum('category', array('General Item', 'Cup & Glass',
            'Dining Ware', 'cookware', 
            'Flask(Tarmoz)', 'Kitchen Ware', 'House Ware', 
            'Religious Product', 'Rug and mattres', 'Wearing', 
            'Accessories', 'Nuts and Fruit Pots'));
            $table->longText('description');
            $table->string('SKU');
            $table->string('item_number', 100)->nullable();
            $table->string('image');

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
