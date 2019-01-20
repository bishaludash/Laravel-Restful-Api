<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seller = Seller::has('products')->get();
        return response()->json(['data'=>$seller], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show($seller)
    {
        $seller = Seller::has('products')->findOrFail($seller);
        if (count($seller) ==0) {
            return response()->json(['error'=>'Not a Seller'], 200);
        }
        return response()->json(['data'=>$seller], 200);
    }

}
