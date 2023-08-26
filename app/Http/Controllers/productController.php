<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\cataloge;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Jorenvh\Share\ShareFacade;




class productController extends Controller
{


    public function home()
    {
        $products = DB::table('products')->where('out_of_stock', '!=', 0)->get();
        $categories = Category::get();
        $cataloges = Cataloge::get();
        return view('dashboard', compact('products', 'categories', 'cataloges'));
    }
    public function products()
    {
        $products = Product::orderBy('category_id', 'asc')->get();
        $categories = Category::get();
        $cataloges = Cataloge::get();

        return view('admin.products', compact('products', 'categories', 'cataloges'));
    }

    public function outOfStock()
    {

        // $products = Product::orderBy('category', 'asc')->where('category', '!=', 'Dinner Set')->get();
        $products = Product::orderBy('category', 'desc')->where('quantity', '==', '0')->get();
        // $products = DB::table('products')->where('category', 'Dinner Set')->get();


        return view('outOfStock', compact('products'));
    }


    public function storeProducts(Request $request)
    {
        if ($request->isMethod('POST')) {
            if (!$request->has('mImage')) {
                return response()->json(['message' => 'Missing file'], 422);
            }
            $name = $request->name;
            $price = $request->price;
            $SKU = $request->SKU;
            $Item_Number = $request->Item_Number;
            $categroy_id = $request->category_id;
            $cataloge_id = $request->cataloge_id;
            $quantity = $request->quantity;
            $image = $request->file('mImage');
            $Description = "No description is added for this product";

            $imageName = time() . '.' . $image->extension();

            $image->move(public_path('images'), $imageName);



            $product = new Product();
            $product->name = $name;
            $product->SKU = $SKU;
            $product->description = $Description;
            $product->item_number = $Item_Number;
            $product->category_id = $categroy_id;
            $product->cataloge_id = $cataloge_id;
            $product->price = $price;
            $product->image = $imageName;
            if ($quantity > 0)
                $product->quantity = $quantity;

            $product->save();
            return back()->with('success', 'The product has been saved');
        }
    }
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        return response()->json([
            'status' => 200,
            'category' => $product
        ]);
    }
    public function removeProduct(Request $request)
    {
        $product_id = $request->input('product_id');
        $product = Product::find($product_id);
        $product::where('id', $product_id)->delete();
        return back()->with('success', 'The Prodcuts has been Succesfully Deleted');
    }
    public function editproduct($id)
    {
        $product = Product::find($id);
        return response()->json([
            'status' => 200,
            'product' => $product
        ]);
    }
    public function updateProduct(Request $request)
    {

        $pr_id = $request->input('pr_id');
        $product = Product::find($pr_id);
        $name = $request->pr_name;

        $product->name = $name;
        $product->price = $request->pr_price;
        $product->SKU = $request->pr_SKU;
        $product->price = $request->pr_price;
        $product->item_number = $request->pr_Item_Number;
        $product->category_id = $request->pr_category_id;
        $product->cataloge_id = $request->cataloge_id;

        $image = $request->file('pr_mImage');

        $imageName = time() . '.' . $image->extension();

        $image->move(public_path('images'), $imageName);
        $product->image = $imageName;
        $product->save();
        return back()->with('catalog_added', 'The Cataloge has been Updated');
    }
    public function searchProduct(Request $request)
    {

        $sercch = $request->input('search');
        $catalog = $request->input('catalog');
        $category = $request->input('category');
        if ($catalog == 'All')
            $products = Product::get()->where('out_of_stock', '!=', 0);
        else
            $products = Product::where('cataloge_id', $catalog)->where('category_id', $category)->where('out_of_stock', '!=', 0)->get();
        return view('prdouct-table', compact('products'));
    }
    public function exportProduct(Request $request)
    {
        $cataloge_id = $request->cataloge_id;
        $category_id = $request->category_id;
        $print_type = $request->print_type;
        $title = $request->cat_title;


        if ($cataloge_id == 'All')
            $products = Product::get()->where('out_of_stock', '!=', 0);
        else
            $products = Product::where('cataloge_id', $cataloge_id)->where('category_id', $category_id)->where('out_of_stock', '!=', 0)->get();
        $data['products'] = $products;

        if ($print_type == '2') {
            $pdf = Pdf::loadView('print.two-items', $data)->setPaper('a4', 'landscape');
        } else
            $pdf = Pdf::loadView('print.one-item', $data)->setPaper('a4', 'landscape');

        return $pdf->stream('invoice.pdf');
    }
    public function filterCategory(Request $request)
    {
        $id = $request->id;
        $categories = Category::where('cataloge_id', $id)->get();
        return view('filter-category', compact('categories'));
    }
    public function toggleProduct($id)
    {
        $product = Product::find($id);
        $product->out_of_stock = $product->out_of_stock === 1 ? 0 : 1;
        $product->save();
    }
}
