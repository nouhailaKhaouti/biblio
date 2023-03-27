<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /* Display a listing of the resource.
     */
    public function index()
    {
        $Genre = Genre::all();
        return response()->json(['response'=>'success','Genres'=>$Genre]);
    }

    /* Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /* Store a newly created resource in storage.
     */
    public function store(GenreRequest $request)
    {
        $data = Genre::create($request->all());
        return response()->json(['created'=>'Genre created successfuly','Genre'=>$data],201);
    }

    /* Display the specified resource.
     */
    public function show($id)
    {
        if(!Genre::find($id)){
            return response()->json(['response'=>'not found'],404);
        }
        // return response()->json(['response'=>'not found'],404);
        return Genre::find($id);
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
        $Genre_update = Genre::find($id);
        $Genre_update->update($request->all());
        return $Genre_update;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Genre::destroy($id);
    }
}
