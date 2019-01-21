<?php

namespace App\Http\Controllers\Transaction;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionSellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($transaction)
    {   
        $transaction = Transaction::find($transaction);
        if (is_null($transaction)) {
            return response()->json(['data'=>'Transaction not found'], 200);
        }
        
        $seller = $transaction->product->seller;
        if (is_null($seller)) {
            return response()->json( ['data'=>'Not Found', 'code'=>'404'], 404);
        }
        return response()->json( ['data'=>$seller, 'code'=>'200'], 200);
    }

    
}
