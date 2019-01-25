<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellerTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($seller)
    {
        $seller = Seller::has('products')->find($seller);
        if (is_null($seller)) {
            return response()->json(['error'=>'Not a Seller'], 200);
        }

        $transactions = $seller->products()
                ->has('transactions')
                ->with('transactions')
                ->get()
                ->pluck('transactions')
                ->collapse()
                ->values();
        return response()->json(['data'=>$transactions], 200);
    }

}
