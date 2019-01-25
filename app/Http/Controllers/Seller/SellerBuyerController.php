<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellerBuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        $buyers = $seller->products()
            ->has('transactions')
            ->with('transactions.buyer')
            ->get()
            ->pluck('transactions')
            ->collapse()
            ->pluck('buyer')
            ->unique('id')
            ->values();

        return response()->json(['data'=>$buyers], 200);            
    }
}
