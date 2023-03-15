<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class productController extends Controller
{
    //
    public function addProducts()
    {

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
?>
