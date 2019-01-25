<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buyers = Buyer::has('transactions')->get();
        return response()->json(['data'=>$buyers], 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function show(Buyer $buyer)
    {
        $buyer = Buyer::has('transactions')->find($buyer);
        if (is_null($buyer)) {
            return response()->json(['error'=>'Not a buyer'], 200);
        }
        return response()->json(['data'=>$buyer], 200);
    }

}
