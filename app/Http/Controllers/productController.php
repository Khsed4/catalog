<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class productController extends Controller
{
    
    public function products() {
        $images = [
            "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/belt.webp",
            "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/img%20(4).webp",
            "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/shoes%20(3).webp",
            "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/img%20(23).webp",
            "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/img%20(17).webp",
            "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/img%20(30).webp",
            "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/belt.webp",
            "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/img%20(4).webp",
            "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/shoes%20(3).webp",
            "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/img%20(23).webp",
            "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/img%20(17).webp",
            "https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/img%20(30).webp",
        ];

        $products  = [];

        for($i = 0; $i < count($images); $i++) {
            $product = new Product();
            $product->id = $i;
            $product->name = "Product Name";
            $product->category = "Category";
            $product->image = $images[$i];
            $product->price = "$61.99";
            array_push($products, $product);
        }

        return view('products', compact('products'));
    }

    public function print_products() {
        $images = [
            "1378.jpg",
            "A070-04G.jpeg",
            "Afghan_pressure_cook_1zENxk9.jpg",
            "DIP-65.jpeg",
            "FLK-042.jpeg",
            "1378.jpg",
            "A070-04G.jpeg",
            "Afghan_pressure_cook_1zENxk9.jpg",
            "DIP-65.jpeg",
            "FLK-042.jpeg",
            "1378.jpg",
            "A070-04G.jpeg",
        ];

        $products  = [];

        for($i = 0; $i < count($images); $i++) {
            $product = new Product();
            $product->id = $i;
            $product->name = "Product Name";
            $product->category = "Category";
            $product->image = $images[$i];
            $product->price = "$61.99";
            array_push($products, $product);
        }

        // return view('products-print', compact('products'));

        return print_pdf('Products Report', view('products-print', compact('products')), 'A4');
    }

    //
    public function addProducts() {
        return view("addProducts");
    }

   public function StoreProduct(Request $request){
    if ($request->isMethod('POST')) {
        // Array ( [Name] => asad [SKU] => asd [price] => fdsafa [Description] => dsfadsf [category] => three [Item_Number] => fdfdfdfd [file] => _DS058.jpg )
        $name = $request->name;
        $image = $request->file('file');
        $imageName = time() . '.' . $image->extension();

        $image->move(public_path('images'),$imageName);
        $price = $request->price;
        $SKU = $request->SKU;
        $Description = $request->description;
        $Item_Number = $request->Item_Number;
        $categroy = $request->category;
        // dd($request->all());

        $product = new Product();
        $product->name = $name;
        $product->SKU = $SKU;
        $product->description = $Description;
        $product->item_number = $Item_Number;
        $product->category = $categroy;
        $product->price = $price;
        $product->image = $imageName;
        $product->save();
        return back()->with('product_added','The product has been saved');

    }
   }

}
