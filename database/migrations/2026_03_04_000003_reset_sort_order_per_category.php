<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ResetSortOrderPerCategory extends Migration
{
    public function up()
    {
        // Reset sort_order to be per-category (1, 2, 3... within each category)
        $products = DB::table('products')
            ->join('category', 'products.category_id', '=', 'category.id')
            ->orderBy('category.name', 'ASC')
            ->orderBy('products.sort_order', 'ASC')
            ->select('products.id', 'products.category_id')
            ->get();

        $counters = [];
        foreach ($products as $product) {
            $catId = $product->category_id;
            if (!isset($counters[$catId])) {
                $counters[$catId] = 0;
            }
            $counters[$catId]++;
            DB::table('products')
                ->where('id', $product->id)
                ->update(['sort_order' => $counters[$catId]]);
        }
    }

    public function down()
    {
        // No reversal needed
    }
}
