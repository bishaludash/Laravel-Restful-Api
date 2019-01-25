<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Product;
use App\Seller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SellerProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        $products = $seller->products;
        return response()->json(['data'=>$products], 200);
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $seller)
    {
        $rules = [
            'name'=>'required',
            'description'=>'required',
            'quantity'=>'required|integer',
            'image'=>'required|image',
        ];
        $this->validate($request, $rules);
        $input = $request->all();
        $input['status'] = Product::UNAVAILABLR_PRODUCT;
        $input['image'] = $request->image
                        ->storeAs($request->name, $request->image->getclientoriginalname());
        $input['seller_id'] = $seller->id;

        $product = Product::create($input);
        return response()->json(['data'=>$product], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller, Product $product)
    {
        $rules = [
            'quantity'=>'integer|min:1',
            'status'=>'in:'.Product::UNAVAILABLR_PRODUCT .','.Product::AVAILABLR_PRODUCT,
            'image' => 'image',
        ];

        $this->validate($request, $rules);
        $product->fill($request->only(['name','description','quantity']));

        if ($request->has('status')) {
            $product->status = $request->status;
        }

        if ($product->isClean()) {
            return response()->json(['error'=>'You need to specify different valiue.'], 422);
        }
        $product->save();
        return response()->json(['data'=>$product], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller, Product $product)
    {
        if ($product->seller_id == $seller->id) {
            Storage::delete($product->image);
             $product->delete();
              return response()->json(['data'=>'The product was deleted successfully.', 'code'=>'200'],200);
        }
       return response()->json(['error'=>'The product does not belong to you.', 'code'=>'401'], 401);
       
    }
}
