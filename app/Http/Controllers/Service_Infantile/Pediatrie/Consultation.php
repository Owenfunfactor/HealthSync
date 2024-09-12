<?php

namespace App\Http\Controllers\Service_Infantile\Pediatrie;

use App\Http\Controllers\Controller;
use App\Models\Child;
use App\Models\Consultation_pediatrie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Consultation extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user(); // Récupérer l'utilisateur authentifié

        // Récupérer les enfants de l'utilisateur authentifié et les formater
        $children = $user->children()->orderBy('created_at', 'asc')->get()->map(function ($child) {
            $now = Carbon::now();
            $date_naissance = Carbon::parse($child->date_naissance);
            $age = $date_naissance->diff($now);
            $child->years = $age->y;
            $child->months = $age->m;
            $child->days = $age->d;
            return $child;
        });

        return view('service_infantile.pediatrie.list_patient', compact('children'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $consultation = new Consultation_pediatrie();
        return view('service_infantile.pediatrie.consultation_form', compact('consultation'));
    }

    public function create_with_User($id)
    {
        $consultation = new Consultation_pediatrie();
        $child = Child::find($id);
        return view('service_infantile.pediatrie.consultation_form', compact('consultation','child'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'motif' => 'required|string',
            'antecedant_medicaux' => 'required|string',
            'suivie_grossesse' => 'required|string|max:255',
            'motif_non_suivie_grossesse' => 'nullable|string',
            'type_accouchement' => 'required|string|max:255',
            'dure_naissance' => 'required|integer',
            'reanimation_neonatale' => 'required|string|max:255',
            'infection_neonatal' => 'required|string|max:255',
            'traitement_medical_infection' => 'nullable|string',
            'ictere_neonatal' => 'required|string|max:255',
            'transfusion' => 'required|string|max:255',
            'nb_transfusion' => 'nullable|integer',
            'autre_info' => 'required|string',
            'vaccination_ajour' => 'required|string|max:255',
            'autre_antecedant' => 'required|string',
            'antecedant_chirurgicaux' => 'required|string',
            'temperature' => 'required|integer',
            'poids' => 'required|integer',
            'taille' => 'required|integer',
            'frequence_cardiaque' => 'required|integer',
            'pouls' => 'required|integer',
            'frequence_respiratoire' => 'required|integer',
            'etat_general' => 'required|string|max:255',
            'autre_etat' => 'nullable|string',
            'mucqueuse' => 'required|string|max:255',
            'aute_info' => 'required|string',
            'signe_physique' => 'required|string',
            'bilan_biologique' => 'required|string',
            'bilan_radiologique' => 'required|string',
            'suspission_diagnostic' => 'required|string',
            'resultat_biologie' => 'required|string',
            'resultat_img_radiologie' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'diagnostic' => 'required|string',
            'traitement.*' => 'required|string', // Validation pour chaque traitement
            'prescription.*' => 'required|string',
            'evolution' => 'required|string|max:255',
            'pronostic' => 'required|string|max:255',
            'diagnostic_sortie' => 'required|string|max:255',
            'type_sortie' => 'required|string|max:255',
            'date_sortie' => 'required|date',
            'child_id' => 'required|integer|exists:children,id',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        // Upload de l'image
        $imageName = time().'.'.$request->resultat_img_radiologie->extension();
        $request->resultat_img_radiologie->move(public_path('assets/img_2'), $imageName);

        // Convertit les traitements en JSON
        $traitementsJson = json_encode($request->input('traitement'));
        $prescriptionJson = json_encode($request->input('prescription'));

        // Crée une nouvelle consultation
        $consultation = new Consultation_pediatrie();
        $consultation->motif = $request->motif;
        $consultation->antecedant_medicaux = $request->antecedant_medicaux;
        $consultation->suivie_grossesse = $request->suivie_grossesse;
        $consultation->motif_non_suivie_grossesse = $request->motif_non_suivie_grossesse;
        $consultation->type_accouchement = $request->type_accouchement;
        $consultation->dure_naissance = $request->dure_naissance;
        $consultation->reanimation_neonatale = $request->reanimation_neonatale;
        $consultation->infection_neonatal = $request->infection_neonatal;
        $consultation->traitement_medical_infection = $request->traitement_medical_infection;
        $consultation->ictere_neonatal = $request->ictere_neonatal;
        $consultation->transfusion = $request->transfusion;
        $consultation->nb_transfusion = $request->nb_transfusion;
        $consultation->autre_info = $request->autre_info;
        $consultation->vaccination_ajour = $request->vaccination_ajour;
        $consultation->autre_antecedant = $request->autre_antecedant;
        $consultation->antecedant_chirurgicaux = $request->antecedant_chirurgicaux;
        $consultation->temperature = $request->temperature;
        $consultation->poids = $request->poids;
        $consultation->taille = $request->taille;
        $consultation->pouls = $request->pouls;
        $consultation->frequence_cardiaque = $request->frequence_cardiaque;
        $consultation->frequence_respiratoire = $request->frequence_respiratoire;
        $consultation->etat_general = $request->etat_general;
        $consultation->autre_etat = $request->autre_etat;
        $consultation->mucqueuse = $request->mucqueuse;
        $consultation->aute_info = $request->aute_info;
        $consultation->signe_physique = $request->signe_physique;
        $consultation->bilan_biologique = $request->bilan_biologique;
        $consultation->bilan_radiologique = $request->bilan_radiologique;
        $consultation->suspission_diagnostic = $request->suspission_diagnostic;
        $consultation->resultat_biologie = $request->resultat_biologie;
        $consultation->resultat_img_radiologie = $imageName;
        $consultation->diagnostic = $request->diagnostic;
        $consultation->traitement = $traitementsJson;
        $consultation->prescription = $prescriptionJson;
        $consultation->evolution = $request->evolution;
        $consultation->pronostic = $request->pronostic;
        $consultation->diagnostic_sortie = $request->diagnostic_sortie;
        $consultation->type_sortie = $request->type_sortie;
        $consultation->date_sortie = $request->date_sortie;
        $consultation->child_id = $request->child_id;
        $consultation->save();
        
        $consultation->users()->attach($request->user_id, ['created_at' => now(), 'updated_at' => now()]);

        return redirect()->route('Service_Infantile.consultation.index')->with('status', 'Consultation enregistré');
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
        $consultation= Consultation_pediatrie::find($id);
        $prescriptions = json_decode($consultation->prescription, true);
        $traitements = json_decode($consultation->traitement, true);
        return view('service_infantile.pediatrie.consultation_form', compact('consultation','prescriptions','traitements'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consultation_pediatrie $consultation)
    {
        $request->validate([
            'motif' => 'nullable|string',
            'antecedant_medicaux' => 'nullable|string',
            'suivie_grossesse' => 'nullable|string|max:255',
            'motif_non_suivie_grossesse' => 'nullable|string',
            'type_accouchement' => 'nullable|string|max:255',
            'dure_naissance' => 'nullable|integer',
            'reanimation_neonatale' => 'nullable|string|max:255',
            'infection_neonatal' => 'nullable|string|max:255',
            'traitement_medical_infection' => 'nullable|string',
            'ictere_neonatal' => 'nullable|string|max:255',
            'transfusion' => 'nullable|string|max:255',
            'nb_transfusion' => 'nullable|integer',
            'autre_info' => 'nullable|string',
            'vaccination_ajour' => 'nullable|string|max:255',
            'autre_antecedant' => 'nullable|string',
            'antecedant_chirurgicaux' => 'nullable|string',
            'temperature' => 'nullable|integer',
            'poids' => 'nullable|integer',
            'taille' => 'nullable|integer',
            'frequence_cardiaque' => 'nullable|integer',
            'pouls' => 'nullable|integer',
            'frequence_respiratoire' => 'nullable|integer',
            'etat_general' => 'nullable|string|max:255',
            'autre_etat' => 'nullable|string',
            'mucqueuse' => 'nullable|string|max:255',
            'aute_info' => 'nullable|string',
            'signe_physique' => 'nullable|string',
            'bilan_biologique' => 'nullable|string',
            'bilan_radiologique' => 'nullable|string',
            'suspission_diagnostic' => 'nullable|string',
            'resultat_biologie' => 'nullable|string',
            'resultat_img_radiologie' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'diagnostic' => 'nullable|string',
            'traitement.*' => 'nullable|string',
            'prescription.*' => 'nullable|string',
            'evolution' => 'nullable|string|max:255',
            'pronostic' => 'nullable|string|max:255',
            'diagnostic_sortie' => 'nullable|string|max:255',
            'type_sortie' => 'nullable|string|max:255',
            'date_sortie' => 'nullable|date',
            'child_id' => 'nullable|integer|exists:children,id',
            'user_id' => 'nullable|integer|exists:users,id',
        ]);

        if ($request->hasFile('resultat_img_radiologie')) {
            $imageName = time().'.'.$request->resultat_img_radiologie->extension();
            $request->resultat_img_radiologie->move(public_path('assets/img_2'), $imageName);
            $consultation->resultat_img_radiologie = $imageName;
        }

        // Convertit les traitements et les prescriptions en JSON
        $traitementsJson = $request->has('traitement') ? json_encode($request->input('traitement')) : $consultation->traitement;
        $prescriptionJson = $request->has('prescription') ? json_encode($request->input('prescription')) : $consultation->prescription;

        // Met à jour les champs de la consultation seulement s'ils sont présents dans la requête
        $consultation->motif = $request->filled('motif') ? $request->motif : $consultation->motif;
        $consultation->antecedant_medicaux = $request->filled('antecedant_medicaux') ? $request->antecedant_medicaux : $consultation->antecedant_medicaux;
        $consultation->suivie_grossesse = $request->filled('suivie_grossesse') ? $request->suivie_grossesse : $consultation->suivie_grossesse;
        $consultation->motif_non_suivie_grossesse = $request->filled('motif_non_suivie_grossesse') ? $request->motif_non_suivie_grossesse : $consultation->motif_non_suivie_grossesse;
        $consultation->type_accouchement = $request->filled('type_accouchement') ? $request->type_accouchement : $consultation->type_accouchement;
        $consultation->dure_naissance = $request->filled('dure_naissance') ? $request->dure_naissance : $consultation->dure_naissance;
        $consultation->reanimation_neonatale = $request->filled('reanimation_neonatale') ? $request->reanimation_neonatale : $consultation->reanimation_neonatale;
        $consultation->infection_neonatal = $request->filled('infection_neonatal') ? $request->infection_neonatal : $consultation->infection_neonatal;
        $consultation->traitement_medical_infection = $request->filled('traitement_medical_infection') ? $request->traitement_medical_infection : $consultation->traitement_medical_infection;
        $consultation->ictere_neonatal = $request->filled('ictere_neonatal') ? $request->ictere_neonatal : $consultation->ictere_neonatal;
        $consultation->transfusion = $request->filled('transfusion') ? $request->transfusion : $consultation->transfusion;
        $consultation->nb_transfusion = $request->filled('nb_transfusion') ? $request->nb_transfusion : $consultation->nb_transfusion;
        $consultation->autre_info = $request->filled('autre_info') ? $request->autre_info : $consultation->autre_info;
        $consultation->vaccination_ajour = $request->filled('vaccination_ajour') ? $request->vaccination_ajour : $consultation->vaccination_ajour;
        $consultation->autre_antecedant = $request->filled('autre_antecedant') ? $request->autre_antecedant : $consultation->autre_antecedant;
        $consultation->antecedant_chirurgicaux = $request->filled('antecedant_chirurgicaux') ? $request->antecedant_chirurgicaux : $consultation->antecedant_chirurgicaux;
        $consultation->temperature = $request->filled('temperature') ? $request->temperature : $consultation->temperature;
        $consultation->poids = $request->filled('poids') ? $request->poids : $consultation->poids;
        $consultation->taille = $request->filled('taille') ? $request->taille : $consultation->taille;
        $consultation->pouls = $request->filled('pouls') ? $request->pouls : $consultation->pouls;
        $consultation->frequence_cardiaque = $request->filled('frequence_cardiaque') ? $request->frequence_cardiaque : $consultation->frequence_cardiaque;
        $consultation->frequence_respiratoire = $request->filled('frequence_respiratoire') ? $request->frequence_respiratoire : $consultation->frequence_respiratoire;
        $consultation->etat_general = $request->filled('etat_general') ? $request->etat_general : $consultation->etat_general;
        $consultation->autre_etat = $request->filled('autre_etat') ? $request->autre_etat : $consultation->autre_etat;
        $consultation->mucqueuse = $request->filled('mucqueuse') ? $request->mucqueuse : $consultation->mucqueuse;
        $consultation->aute_info = $request->filled('aute_info') ? $request->aute_info : $consultation->aute_info;
        $consultation->signe_physique = $request->filled('signe_physique') ? $request->signe_physique : $consultation->signe_physique;
        $consultation->bilan_biologique = $request->filled('bilan_biologique') ? $request->bilan_biologique : $consultation->bilan_biologique;
        $consultation->bilan_radiologique = $request->filled('bilan_radiologique') ? $request->bilan_radiologique : $consultation->bilan_radiologique;
        $consultation->suspission_diagnostic = $request->filled('suspission_diagnostic') ? $request->suspission_diagnostic : $consultation->suspission_diagnostic;
        $consultation->resultat_biologie = $request->filled('resultat_biologie') ? $request->resultat_biologie : $consultation->resultat_biologie;
        $consultation->diagnostic = $request->filled('diagnostic') ? $request->diagnostic : $consultation->diagnostic;
        $consultation->traitement = $traitementsJson;
        $consultation->prescription = $prescriptionJson;
        $consultation->evolution = $request->filled('evolution') ? $request->evolution : $consultation->evolution;
        $consultation->pronostic = $request->filled('pronostic') ? $request->pronostic : $consultation->pronostic;
        $consultation->diagnostic_sortie = $request->filled('diagnostic_sortie') ? $request->diagnostic_sortie : $consultation->diagnostic_sortie;
        $consultation->type_sortie = $request->filled('type_sortie') ? $request->type_sortie : $consultation->type_sortie;
        $consultation->date_sortie = $request->filled('date_sortie') ? $request->date_sortie : $consultation->date_sortie;
        $consultation->child_id = $request->filled('child_id') ? $request->child_id : $consultation->child_id;

        $consultation->update();

        dd($consultation);

        return redirect()->route('Service_Infantile.consultation.index')->with('status', 'Consultation mise à jour');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
