<?php

namespace App\Http\Controllers;

use App\Models\Cataloge;
use App\Models\Product;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

class CatalogeController extends Controller
{
    //
    public function StoreCataloge(Request $request)
    {
        $cataloge = new Cataloge();
        if ($request->isMethod('POST')) {
            $name = $request->name;
            $description = $request->description;
            $cataloge->name = $name;
            $cataloge->description = $description;
            $cataloge->save();
            return back()->with('catalog_added', 'The Cataloge has been saved');
        }
    }
    public function showCataloges(Request $request)
    {

        $cataloges = Cataloge::all();

        return view('admin.catalogues', compact('cataloges'));
    }

    public function editCatalog($id)
    {


        $cataloge = Cataloge::find($id);
        return response()->json([
            'status' => 200,
            'catalog' => $cataloge
        ]);
    }
    public function update(Request $request)
    {

        $cat_id = $request->input('cat_id');
        $catalog = Cataloge::find($cat_id);
        $name = $request->name;
        $description = $request->description;
        $catalog->name = $name;
        $catalog->description = $description;
        $catalog->save();
        return back()->with('catalog_added', 'The Cataloge has been Updated');
    }
    public function deleteCatalog($id)
    {

        return response()->json([
            'status' => 200,
            'id' => $id
        ]);
    }
    public function remove(Request $request)
    {
         $cat_id = $request->input('cataloge_id');
         $catalog = Cataloge::find($cat_id);
         $catalog::where('id', $cat_id)->delete();
         return back()->with('success', 'The Cataloge has been Deleted Succesfully');
    }

}
