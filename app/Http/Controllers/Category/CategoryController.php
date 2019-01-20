<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category =Category::all();
        return response()->json(['data'=>$category], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'=>'required',
            'description'=>'required'
        ];
        $validator = $this->validate($request, $rules);
        $name = $request->only('name','description');
        $category = Category::create($name);
        return response()->json(['data'=>$category], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($category)
    {          
        $category = Category::find($category);
        if (is_null($category)) {
            return response()->json(['data'=>'Category does not exist'], 200);
        }
        return response()->json(['data'=>$category], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->fill($request->only('name','description')); 

        if (!$category->isDirty()) {
            return response()->json(['data'=>'You need to specify different value to update','code'=>422], 422);
        }
        $category->save();
        return response()->json(['data'=>$category],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['data'=>$category], 200);
    }
}
