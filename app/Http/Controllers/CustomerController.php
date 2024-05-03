<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the customers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $this->authorize('viewAny', Customer::class);
    
        return Customer::all();
    }
    
    /**
     * Store a newly created customer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
    
    /**
     * Display the specified customer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        $this->authorize('view', $customer);
    
        return $customer;
    }
    
    /**
     * Update the specified customer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    
    /**
     * Remove the specified customer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $this->authorize('delete', $customer);
    
        $customer->forceDelete();
    
        return Response::json(['message' => 'Customer deleted successfully'], 204);
    }
    
    /**
     * Soft delete the specified customer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function softDelete($id)
    {
        $customer = Customer::findOrFail($id);
        $this->authorize('softDelete', $customer);

        $customer->delete();
    
        return Response::json(['message' => 'Customer soft deleted successfully'], 200);
    }
      
}
