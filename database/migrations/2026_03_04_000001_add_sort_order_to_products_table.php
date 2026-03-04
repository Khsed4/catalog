<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddSortOrderToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedInteger('sort_order')->default(0)->after('quantity');
            $table->index('sort_order');
        });

        // Initialize existing products' sort_order based on category name ordering
        $products = DB::table('products')
            ->join('category', 'products.category_id', '=', 'category.id')
            ->orderBy('category.name', 'ASC')
            ->select('products.id')
            ->get();

        foreach ($products as $index => $product) {
            DB::table('products')
                ->where('id', $product->id)
                ->update(['sort_order' => $index + 1]);
        }
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['sort_order']);
            $table->dropColumn('sort_order');
        });
    }
}
