<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /* Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return response()->json(['response'=>'success','categories'=>$category]);
    }

    /* Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /* Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = Category::create($request->all());
        return response()->json(['created'=>'category created successfuly','category'=>$data],201);
    }

    /* Display the specified resource.
     */
    public function show($id)
    {
        if(!Category::find($id)){
            return response()->json(['response'=>'not found'],404);
        }
        // return response()->json(['response'=>'not found'],404);
        return Category::find($id);
    }

    /* Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /* Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $category_update = Category::find($id);
        $category_update->update($request->all());
        return $category_update;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Category::destroy($id);
    }
}