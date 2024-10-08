<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ExcelExportController extends Controller
{
    public function index()
    {
        $sky = Product::select('SKU')->get();

        return view('export-excel',compact($sky));
    }
}
