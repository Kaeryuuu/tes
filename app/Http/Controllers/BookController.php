<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {

        $book = Book::latest()->paginate(5);

        return view('book.index', compact('book'));
    }

    public function create()
    {
        return view('book.create');
    }

    public function store(Request $request)
    {
        $request->validate([ 
            'title' => 'required',             
            'author' => 'required', 
            'pages' => 'required',
            'image' => 'nullable',
        ]); 

        $imagepath = null;
        
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('public/images'), $imageName);
            $imagepath = 'public/images/' . $imageName;
        }

        Book::create([ 
            'title' => $request->title, 
            'author' => $request->author, 
            'pages' => $request->pages,
            'image' => $imagepath,
        ]); 


        try {
            return redirect()->route('book.index');
        } catch (Exception $e) {
            return redirect()->route('book.index');
        }
    }

    public function edit($id)
    {
        $book = Book::find($id);

        return view('book.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([ 
            'title' => 'required',
            'author' => 'required', 
            'pages' => 'required',
            'image' => 'nullable|image', 
        ]);

        $imagepath = $book->image;
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('public/images'), $imageName);
            $imagepath = 'public/images/' . $imageName;
        }

        $book->update([ 
            'title' => $request->title, 
            'author' => $request->author, 
            'pages' => $request->pages,
            'image' => $imagepath,
        ]); 

        $book->save();

        return redirect()->route('book.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();

        return redirect()->route('book.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
