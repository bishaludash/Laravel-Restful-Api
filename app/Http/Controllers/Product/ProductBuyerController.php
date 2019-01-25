<?php

namespace App\Http\Controllers\Product;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductBuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $buyer = $product->transactions()
                ->with('buyer')
                ->get()
                ->pluck('buyer');

        return response()->json(['data'=>$buyer], 200);
    }
}
