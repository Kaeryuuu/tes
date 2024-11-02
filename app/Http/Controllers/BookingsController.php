<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
   public function index()
   {
       $bookings = Bookings::latest()->paginate(5);
       return view('bookings.index', compact('bookings'));
   }

   public function create() 
   { 
       $books = \App\Models\Book::all();
       return view('bookings.create', compact('books')); 
   }

   public function store(Request $request) 
   { 
       $validated = $request->validate([ 
           'id_book' => 'required|exists:books,id',
           'class' => 'required|string|max:255',
           'price' => 'required|numeric', 
       ]); 

       try {
           Bookings::create($validated);

           return redirect()
               ->route('bookings.index')
               ->with('success', 'Booking created successfully.');

       } catch (\Exception $e) {
           return redirect()
               ->back()
               ->withInput()
               ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
       }
   } 

   public function edit($id) 
   { 
       $bookings = Bookings::findOrFail($id);
       $books = \App\Models\Book::all(); 
       return view('bookings.edit', compact('bookings', 'books')); 
   }

   public function update(Request $request, $id) 
   { 
       $bookings = Bookings::findOrFail($id); 

       $validated = $request->validate([ 
           'id_book' => 'required|exists:books,id',
           'class' => 'required|string|max:255',
           'price' => 'required|numeric', 
       ]);

       try {
           $bookings->update($validated);

           return redirect()
               ->route('bookings.index')
               ->with('success', 'Data Berhasil Diubah!');

       } catch (\Exception $e) {
           return redirect()
               ->back()
               ->withInput()
               ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
       }
   } 

   public function destroy($id) 
   { 
       try {
           $bookings = Bookings::findOrFail($id); 
           $bookings->delete(); 

           return redirect()
               ->route('bookings.index')
               ->with('success', 'Data Berhasil Dihapus!');

       } catch (\Exception $e) {
           return redirect()
               ->back()
               ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
       }
   }
}