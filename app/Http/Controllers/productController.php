<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use DB;

use Barryvdh\DomPDF\Facade\Pdf;

class productController extends Controller
{
public function home(){
    return view('layouts.app');
}

    public function products()
    {

        // $products = Product::orderBy('category', 'asc')->where('category', '!=', 'Dinner Set')->get();
        $products = Product::orderBy('temp', 'desc')->where('quantity', '>', '0')->get();
        // $products = DB::table('products')->where('category', 'Dinner Set')->get();


        return view('products-print', compact('products'));
    }
    public function outOfStock()
    {

        // $products = Product::orderBy('category', 'asc')->where('category', '!=', 'Dinner Set')->get();
        $products = Product::orderBy('category', 'desc')->where('quantity', '==', '0')->get();
        // $products = DB::table('products')->where('category', 'Dinner Set')->get();


        return view('outOfStock', compact('products'));
    }
    public function dinner()
    {
        $products = DB::table('products')->where('category', 'Dinner Set')->get();
        return view('products-print', compact('products'));
    }
    public function print_products()
    {


        $products = Product::orderBy('category', 'asc')->where('quantity', '>', '0')->get();

        $name = 'invoice' . time() . '.pdf';


        // $pdf = Pdf::loadView('products-print', compact('products'))->setPaper('A4', 'landscape')->save(public_path('pdfs/' . $name));
        $pdf = Pdf::loadView('products-print', compact('products'))->setPaper('A4', 'landscape');

        return $pdf->stream($name);
    }

    //
    public function addProducts()
    {
        return view("addProducts");
    }

    public function StoreProduct(Request $request)
    {
        if ($request->isMethod('POST')) {
            // Array ( [Name] => asad [SKU] => asd [price] => fdsafa [Description] => dsfadsf [category] => three [Item_Number] => fdfdfdfd [file] => _DS058.jpg )
            $name = $request->name;
            $image = $request->file('file');
            $imageName = time() . '.' . $image->extension();

            $image->move(public_path('images'), $imageName);
            $price = $request->price;
            $SKU = $request->SKU;
            $Description = $request->description;
            $Item_Number = $request->Item_Number;
            $categroy = $request->category;


            $product = new Product();
            $product->name = $name;
            $product->SKU = $SKU;
            $product->description = $Description;
            $product->item_number = $Item_Number;
            $product->category = $categroy;
            $product->price = $price;
            $product->image = $imageName;
            $product->save();
            return back()->with('product_added', 'The product has been saved');
        }
    }
    public function adminProducts()
    {
        return view("admin.products");
    }
    public function adminCatalogues()
    {
        return view("admin.catalogues");
    }
}
