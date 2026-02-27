<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
use Illuminate\Http\Request;

class CatalogueController extends Controller
{

    public function showCatalogues()
    {
        $catalogues = Catalogue::orderBy('name', 'ASC')->get();
        return view('admin.catalogues', compact('catalogues'));
    }

    public function storeCatalogue(Request $request)
    {
        $catalogue = new Catalogue();
        $catalogue->name = $request->name;
        $catalogue->description = $request->description;
        $catalogue->save();

        return back()->with('success', 'The Catalogue has been added');
    }

    public function deleteCatalogue($id)
    {
        $catalogue = Catalogue::find($id);
        return response()->json([
            'status' => 200,
            'catalogue' => $catalogue
        ]);
    }

    public function removeCatalogue(Request $request)
    {
        $catalogue_id = $request->input('catalogue_id');
        $catalogue = Catalogue::find($catalogue_id);
        $catalogue::where('id', $catalogue_id)->delete();
        return back()->with('success', 'The Catalogue has been Deleted Successfully');
    }

    public function editCatalogue($id)
    {
        $catalogue = Catalogue::find($id);
        return response()->json([
            'status' => 200,
            'catalogue' => $catalogue
        ]);
    }

    public function updateCatalogue(Request $request)
    {
        $cat_id = $request->input('cat_id');
        $catalogue = Catalogue::find($cat_id);
        $catalogue->name = $request->name;
        $catalogue->description = $request->description;
        $catalogue->save();
        return back()->with('success', 'The Catalogue has been Updated');
    }
}
