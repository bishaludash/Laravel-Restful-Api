<?php

namespace App\Http\Controllers\Transaction;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::all();
        return response()->json(['data'=>$transaction], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($transaction)
    {
        $transaction = Transaction::find($transaction);
        if (is_null($transaction)) {
            return response()->json(['data'=>'Transaction not found'], 200);
        }
        return response()->json(['data'=>$transaction], 200);
    }

}
