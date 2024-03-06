<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class CustomerController extends Controller
{
    public function index()
    {  
        $this->authorize('viewAny', Customer::class);
    
        return Customer::all();
    }
    
    public function store(Request $request)
    {
        $this->authorize('create', Customer::class);
    
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'phone_number' => 'required',
            'address' => 'required',
        ]);
    
        return Customer::create($request->all());
    }
    
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        $this->authorize('view', $customer);
    
        return $customer;
    }
    
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $this->authorize('update', $customer);
    
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email,' . $id,
            'phone_number' => 'required',
            'address' => 'required',
        ]);
    
        $customer->update($request->all());
    
        return $customer;
    }
    
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $this->authorize('delete', $customer);
    
        $customer->forceDelete();
    
        return Response::json(['message' => 'Medication deleted successfully'], 204);
    }
    
    public function softDelete($id)
    {
        $customer = Customer::findOrFail($id);
        $this->authorize('softDelete', $customer);

        $customer->delete();
    
        return Response::json(['message' => 'Medication deleted successfully'], 200);
    }
      
}
