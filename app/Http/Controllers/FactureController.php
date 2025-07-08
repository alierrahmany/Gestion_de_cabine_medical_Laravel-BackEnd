<?php


namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Patient;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    /**
     * Fetch all invoices.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factures = Facture::with('patient')->get();
        return response()->json($factures);
    }

    /**
     * Fetch a single invoice by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $facture = Facture::with('patient')->findOrFail($id);
        return response()->json($facture);
    }

    /**
     * Create a new invoice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'date_facture' => 'required|date',
            'montant' => 'required|numeric',
            'statut' => 'required|string',
            'details' => 'nullable|string',
        ]);

        $facture = Facture::create($request->all());
        return response()->json($facture, 201);
    }

    /**
     * Update an existing invoice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'patient_id' => 'sometimes|exists:patients,id',
            'date_facture' => 'sometimes|date',
            'montant' => 'sometimes|numeric',
            'statut' => 'sometimes|string',
            'details' => 'nullable|string',
        ]);

        $facture = Facture::findOrFail($id);
        $facture->update($request->all());
        return response()->json($facture);
    }

    /**
     * Delete an invoice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $facture = Facture::findOrFail($id);
        $facture->delete();
        return response()->json(null, 204);
    }
}