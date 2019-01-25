<?php

namespace App\Http\Controllers\Product;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $categories = $product->categories;
        return response()->json(['data'=>$categories, 'code'=>200], 200);
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, Category $category)
    {
        //attach , sync, syncWithoutDetaching
        $product->categories()->syncWithoutDetaching([$category->id]);
        return response()->json(['data'=>$product->categories], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Category $category)
    {
        //detach
        $product->categories()->detach($category->id);
        return response()->json(['data'=>'Category removed', 200]);
    }
}
