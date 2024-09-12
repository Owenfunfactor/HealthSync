<?php

namespace App\Http\Controllers\Service_Infantile\Infirmerie;

use App\Http\Controllers\Controller;
use App\Models\Consultation_pediatrie;
use App\Models\Suivie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuivieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user(); // Récupérer l'utilisateur authentifié

        // Récupérer les enfants de l'utilisateur authentifié et les formater
        $consultations = $user->consultation_pediatries()->orderBy('created_at', 'asc')->get();

        return view('service_infantile.infirmerie.consultation_assigne', compact('consultations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

     /**
     * Show the form for creating a new resource with precharge consultation_Pediatrie.
     */
    public function create_with_consultation($id)
    {
       $suivie = new Suivie();
       $consultation = Consultation_pediatrie::find($id);
       
       return view('service_infantile.infirmerie.suivie_form_create',compact('suivie','consultation'));
    }
   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données
         $request->validate([
            'observation.*' => 'nullable|string|max:255',
            'combined_traitements' => 'nullable|string',
            'consultation_pediatrie_id' => 'required|integer|exists:consultation_pediatries,id',
        ]);

        // Création de la consultation
        $suivie = new Suivie();
        $suivie->nom = "Khamala HARIS";
        $suivie->consultation_pediatrie_id = $request->input('consultation_pediatrie_id');
        
        // Traitements combinés au format JSON
        $traitementsArray = [];
        if ($request->has('combined_traitements')) {
            $traitementsArray = explode(';', $request->input('combined_traitements'));
        }
        $suivie->follow_up = json_encode($traitementsArray);
        
        // Observations
        $suivie->observation = json_encode($request->input('observation', []));
        
        // Sauvegarde de la consultation
        $suivie->save();

        // Redirection ou retour avec un message de succès
        return redirect()->route('Service_Infantile.suivie.index')->with('success', 'Suivie enregistrée avec succès.');
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
        $suivie = Suivie::find($id);
        return view('service_infantile.infirmerie.suivie_form',compact('suivie'));

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Suivie $suivie)
    {
        // Validation des données
        $validated = $request->validate([
            'nom' => 'nullable|string|max:255',
            'observation.*' => 'nullable|string|max:255',
            'combined_traitements' => 'nullable|string',
        ]);

        // Mise à jour des attributs de la consultation
        $suivie->nom = $request->input('nom');

        // Traitements combinés au format JSON
        $traitementsArray = [];
        if ($request->has('combined_traitements')) {
            $traitementsArray = explode(';', $request->input('combined_traitements'));
        }
        $suivie->follow_up = json_encode($traitementsArray);

        // Observations
        $suivie->observation = json_encode($request->input('observation', []));

        // Sauvegarde de la consultation mise à jour
        $suivie->update();

        $modification = $suivie->demandeModif;
        $modification->status = 0;
        $modification->update();

        // Redirection ou retour avec un message de succès
        return redirect()->route('Service_Infantile.suivie.index')->with('success', 'Suivie mise à jour avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
