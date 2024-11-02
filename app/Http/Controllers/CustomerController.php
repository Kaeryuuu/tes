<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Customer::latest()->paginate(5);
        return view('customer.index', compact('customer'));
    }

    public function create() 
    { 
        $bookings = \App\Models\Bookings::all();
        return view('customer.create', compact('bookings')); 
    }

    public function store(Request $request) 
    { 
        $request->validate([ 
            'name' => 'required',             
            'email' => 'required', 
            'phone' => 'required',
            'quantity' => 'required',
            'id_bookings' => 'required'
        ]); 

        Customer::create([ 
            'name' => $request->name, 
            'email' => $request->email,
            'phone' => $request->phone,
            'quantity' => $request->quantity,
            'id_bookings' => $request->id_bookings,
        ]); 
        try { 
            return redirect()->route('customer.index'); 
        } catch (Exception $e) { 
            return redirect()->route('customer.index'); 
        } 
    } 

    public function edit($id) 
    { 
        $customer = Customer::find($id);
        $bookings = \App\Models\Bookings::all(); 
        return view('customer.edit', compact('customer', 'bookings')); 
    }

    public function update(Request $request, $id) 
    { 
        $customer = Customer::find($id); 
        $request->validate([ 
            'name' => 'required',             
            'email' => 'required', 
            'phone' => 'required',
            'quantity' => 'required',
            'id_bookings' => 'required'
        ]);

        $customer->update([ 
            'name' => $request->name, 
            'email' => $request->email,
            'phone' => $request->phone,
            'quantity' => $request->quantity,
            'id_bookings' => $request->id_bookings,
        ]); 
        return redirect()->route('customer.index')->with(['success' => 'Data Berhasil Diubah!']); 
    } 

    public function destroy($id) 
    { 
        $customer = Customer::find($id); 
        $customer->delete(); 
        return redirect()->route('customer.index')->with(['success' => 'Data Berhasil Dihapus!']); 
    }
}
