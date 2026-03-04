<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Catalogue;
use App\Models\CompanySetting;
use Illuminate\Support\Facades\DB;




class ProductController extends Controller
{

    public function test()
    {
        $test = "This is my name, and that's your name, Is it okay?";
        return view('test', compact('test'));
    }
    public function home()
    {
        $products = Product::where('out_of_stock', false)
            ->join('category', 'products.category_id', '=', 'category.id')
            ->orderBy('category.name', 'ASC')
            ->orderBy('products.sort_order', 'ASC')
            ->select('products.*', 'category.name as category_name')
            ->get();

        $categories = Category::orderBy('name', 'ASC')->get();
        $catalogues = Catalogue::orderBy('name', 'ASC')->get();
        $company = CompanySetting::first();

        return view('dashboard', compact('products', 'categories', 'catalogues', 'company'));
    }
    public function products()
    {
        $products = Product::join('category', 'products.category_id', '=', 'category.id')
            ->orderBy('category.name', 'ASC')
            ->orderBy('products.sort_order', 'ASC')
            ->select('products.*', 'category.name as category_name')
            ->get();

        $categories = Category::orderBy('name', 'ASC')->get();
        $catalogues = Catalogue::orderBy('name', 'ASC')->get();

        return view('admin.products', compact('products', 'categories', 'catalogues'));
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
            $quantity = $request->quantity;
            $image = $request->file('mImage');
            $Description = "No description is added for this product";

            $imageName =  $request->SKU . '.' . $image->extension();

            $image->move(public_path('images'), $imageName);

            $product = new Product();
            $product->name = $name;
            $product->SKU = $SKU;
            $product->description = $Description;
            $product->item_number = $Item_Number;
            $product->category_id = $categroy_id;
            $product->catalogue_id = $request->catalogue_id;
            $product->price = $price;
            $product->original_price = $request->original_price;
            $product->set_price = $request->set_price;
            $product->image = $imageName;
            if ($quantity > 0)
                $product->quantity = $quantity;

            $product->sort_order = (Product::where('category_id', $categroy_id)->max('sort_order') ?? 0) + 1;
            $product->save();
            return back()->with('success', 'The product has been saved');
        }
    }

    public function updateProductOrder(Request $request)
    {
        $order = $request->input('order', []);
        foreach ($order as $index => $id) {
            Product::where('id', $id)->update(['sort_order' => $index + 1]);
        }
        return response()->json(['status' => 'success']);
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
        $product->original_price = $request->pr_original_price;
        $product->set_price = $request->pr_set_price;
        $product->SKU = $request->pr_SKU;
        $product->item_number = $request->pr_Item_Number;
        $product->category_id = $request->pr_category_id;
        $product->catalogue_id = $request->pr_catalogue_id;

        if ($request->hasFile('pr_mImage')) {
            $image = $request->file('pr_mImage');
            $imageName = $request->pr_SKU . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }

        $product->save();
        return back()->with('success', 'The Product has been Updated');
    }
    public function searchProduct(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');
        $catalogue = $request->input('catalogue');

        $query = Product::where('out_of_stock', false);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('products.name', 'like', '%' . $search . '%')
                  ->orWhere('products.SKU', 'like', '%' . $search . '%')
                  ->orWhere('products.item_number', 'like', '%' . $search . '%');
            });
        }

        if ($category && $category != '0' && $category != 'All') {
            $query->where('products.category_id', $category);
        }

        if ($catalogue && $catalogue != 'All') {
            $query->where('products.catalogue_id', $catalogue);
        }

        $products = $query->join('category', 'products.category_id', '=', 'category.id')
            ->orderBy('category.name', 'ASC')
            ->orderBy('products.sort_order', 'ASC')
            ->select('products.*', 'category.name as category_name')
            ->get();

        return view('prdouct-table', compact('products'));
    }
    public function exportProduct(Request $request)
    {
        $category_id = $request->category_id;
        $catalogue_id = $request->catalogue_id;
        $print_type = $request->print_type;
        $title = $request->cat_title ?? 'Catalog';

        // Fetch company settings for cover page
        $company = CompanySetting::first();

        // Build query - sort by category name, then sort_order within category
        $query = Product::where('out_of_stock', false)
            ->join('category', 'products.category_id', '=', 'category.id')
            ->orderBy('category.name', 'ASC')
            ->orderBy('products.sort_order', 'ASC')
            ->select('products.*', 'category.name as category_name');

        if ($category_id && $category_id != '0' && $category_id != 'All') {
            $query->where('products.category_id', $category_id);
        }

        if ($catalogue_id && $catalogue_id != 'All') {
            $query->where('products.catalogue_id', $catalogue_id);
        }

        $products = $query->get();

        $data = compact('products', 'company', 'title');

        $template = ($print_type == '2') ? 'print.two-items' : 'print.one-item';
        return view($template, $data);
    }
    public function carpets(Request $request)
    {
        $products = Product::join('category', 'products.category_id', '=', 'category.id')
            ->orderBy('category.name', 'ASC')
            ->orderBy('products.sort_order', 'ASC')
            ->orderBy('products.name', 'ASC')
            ->select('products.*')
            ->get();

        return view('print/one-item-carpets', compact('products'));
    }

    public function filterCategory(Request $request)
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('filter-category', compact('categories'));
    }
    public function toggleProduct($id)
    {
        $product = Product::find($id);
        $product->out_of_stock = $product->out_of_stock === 1 ? 0 : 1;
        $product->save();
    }
}
