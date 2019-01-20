<?php

namespace App\Http\Controllers\Transaction;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $transaction)
    {   
        // Check if transaction exists
        $transaction = Transaction::find($transaction);
        if (is_null($transaction)) {
            return response()->json(['data'=>'Transaction not found','code'=>404], 404);
        }
        // Get transaction categories
        $categories =  $transaction->product->categories;
        if (is_null($categories)) {
            return response()->json(['data'=>'Category not found'], 404);
        }
        return response()->json(['data'=>$categories], 200);
    }

}
