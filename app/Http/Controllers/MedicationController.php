<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class MedicationController extends Controller
{
    /**
     * Display a listing of the medications.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Medication::class);

        return Medication::all();
    }

    /**
     * Store a newly created medication in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Medication::class);

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required|numeric',
            // Add other validation rules as needed
        ]);

        return Medication::create($request->all());
    }

    /**
     * Display the specified medication.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medication = Medication::findOrFail($id);
        $this->authorize('view', $medication);

        return $medication;
    }

    /**
     * Update the specified medication in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        $medication = Medication::findOrFail($id);
        $this->authorize('update', $medication);

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required|numeric',
            
        ]);

        $medication->update($request->all());

        return $medication;
    }

    /**
     * Remove the specified medication from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medication = Medication::findOrFail($id);
        $this->authorize('delete', $medication);
       
        $medication->forceDelete();

        return Response::json(['message' => 'Medication deleted successfully'], 200);
    }

    /**
     * Soft delete the specified medication.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function softDelete($id)
    {
        $medication = Medication::findOrFail($id);
        $this->authorize('softDelete', $medication);
       

        $medication->delete();

        return Response::json(['message' => 'Medication  soft deleted successfully'], 200);
    }
}
