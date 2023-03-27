<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Books = Book::with('Genres')->get();

        return response()->json([
            'status' => 'success',
            'Books' => $Books
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        
        $this->authorize('create');
        $Genres = $request->input('Genres', []); // get the Genres from the request;
        $Book = new Book();
        $Book->user_id =auth()->user()->id;
        $Book->category_id = $request->category_id;
        $Book->content =$request->content;
        $Book->title =$request->title;
        $Book->save();
        try {

            $Book->Genres()->attach($Genres);
    

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Failed to attache Genres to Book: " . $e->getMessage()
            ], 500);
        }
        return response()->json([
            'status' => true,
            'message' => "Book created successfully!",
            'Book' => $Book
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $Book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $Book)
    {
        $Book->find($Book->id);
        if (!$Book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json($Book, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $Book
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request,$id)
    {
       
        $Book=Book::find($id);
        $this->authorize('update',$Book);
        if (!$Book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        $Genres = $request->input('Genres', []);
        try {
            $Book->update($request->all());
            $Book->Genres()->sync($Genres);
        } catch (\Exception) {
            return response()->json(['message' => 'Failed to update Book'], 405);
        }

        return response()->json([
            'status' => true,
            'message' => "Book Updated successfully!",
            'Book' => $Book
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $Book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Book=Book::find($id);
        $this->authorize('delete',$Book);
        $Book->Genres()->detach();
        $Book->delete();

        if (!$Book) {
            return response()->json([
                'message' => 'Book not found'
            ], 404);
        }
        
        return response()->json([
            'status' => true,
            'message' => 'Book deleted successfully'
        ], 200);
    }
}
