<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Jorenvh\Share\ShareFacade;

class SocialShareButtonsController extends Controller
{

    public function ShareWidget(Request $request)
    {

        $shareURL =  url('/') . '/newproducts' . '?' . http_build_query([
            'catalog' => $request->catalog,
            'category' => $request->category
        ]);


        $shareComponent = ShareFacade::page(
            urlencode($shareURL),
            "Please take a look at Unique Natural LLC New Products Cataloge.",
        )
            ->facebook()
            ->telegram()
            ->whatsapp();

        return view('share-component', compact('shareComponent'));
    }
    public function showShare(Request $request)

    {
        $category_id = $request->category;
        $cataloge_id = $request->catalog;
        if ($cataloge_id == 'All')
            $products = Product::get()->where('out_of_stock', '!=', 0);
        else
            $products = Product::where('cataloge_id', $cataloge_id)->where('category_id', $category_id)->where('out_of_stock', '!=', 0)->get();
        return view('share-show', compact('products'));
    }
}
