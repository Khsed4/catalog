<?php

namespace App\Http\Controllers;

use App\Models\Cataloge;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function showCategories()
    {
        $category = Category::all();
        $cateloges = Cataloge::all();
        return view('admin.category', compact('category', 'cateloges'));
    }
    public function storeCategory(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->cataloge_id = $request->cataloge_id;
        $category->save();

        return back()->with('catalog_added', 'The Category has been added');
    }
    public function deleteCategory($id)
    {
        $category = Cataloge::find($id);
        return response()->json([
            'status' => 200,
            'category' => $category
        ]);
    }
    public function removeCategory(Request $request)
    {
        $cat_id = $request->input('category_id');
        $category = Category::find($cat_id);
        $category::where('id', $cat_id)->delete();
        return back()->with('catalog_added', 'The Category has been Deleted Succesfully');
    }
    public function editCategory($id)
    {

        $category = Category::find($id);
        return response()->json([
            'status' => 200,
            'category' => $category
        ]);
    }
    public function update(Request $request)
    {
        $cat_id = $request->input('cat_id');
        $category = Category::find($cat_id);
        $name = $request->name;
        $cataloge_id = $request->cataloge_id;
        $description = $request->description;
        $category->name = $name;
        $category->description = $description;
        $category->cataloge_id = $cataloge_id;
        $category->save();
        return back()->with('catalog_added', 'The Category has been Updated');
    }
}
