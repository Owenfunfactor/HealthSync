<?php

namespace App\Http\Controllers\Service_Infantile\Infirmerie;

use App\Http\Controllers\Controller;
use App\Models\Modification;
use Illuminate\Http\Request;

class Demande_Modification extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modifications = Modification::orderBy('created_at','asc')->get();
        return view('service_infantile.pediatrie.list_demande',compact('modifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function approve($id)
    {
        $modification = Modification::findOrFail($id);
        $modification->status = 1; // Suppose that 1 means approved
        $modification->save();

        return response()->json(['success' => true]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'motif' => 'required|string',
            'consultation_id' => 'required|exists:consultation_pediatries,id',
            'infirmier_id' => 'required|exists:users,id',
            'medecin_id' => 'required|exists:users,id',
            'suivie_id' => 'nullable|exists:suivies,id'
        ]);

        // Création de la modification de consultation
        $modification = new Modification();
        $modification->motif = $request->motif;
        $modification->consultation_pediatrie_id = $request->consultation_id;
        $modification->medecin_id = $request->medecin_id;
        $modification->infirmier_id = $request->infirmier_id;
        $modification->suivie_id = $request->suivie_id;
        
        // Sauvegarde de la modification
        $modification->save();

        // Redirection avec un message de succès
        return redirect()->back()->with('status', 'Demande envoyé');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function reject($id)
    {
        $modification = Modification::find($id);
        $modification->delete();

        return response()->json(['success' => true]);
    }
}
