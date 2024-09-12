<?php

namespace App\Http\Controllers\Service_Infantile;

use App\Http\Controllers\Controller;
use App\Models\Child;
use App\Models\Consultation_pediatrie;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class ChildrenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $children = Child::orderBy('created_at', 'desc')->get()->map(function ($child) {
            $now = Carbon::now();
            $date_naissance = Carbon::parse($child->date_naissance);
            $age = $date_naissance->diff($now);
            $child->years = $age->y;
            $child->months = $age->m;
            $child->days = $age->d;
            return $child;
        });

        return view('service_infantile.acceuil.index', compact('children'));
    }

    public function index_10()
    {
        $children = Child::orderBy('created_at', 'desc')->take(10)->get()->map(function ($child) {
            $now = Carbon::now();
            $date_naissance = Carbon::parse($child->date_naissance);
            $age = $date_naissance->diff($now);
            $child->years = $age->y;
            $child->months = $age->m;
            $child->days = $age->d;
            return $child;
        });

        $childnumber = Child::count();
        $consultationnumber = Consultation_pediatrie::count();

        $mostCommonDiagnostic = Consultation_pediatrie::select('diagnostic')
        ->groupBy('diagnostic')
        ->orderByRaw('COUNT(*) DESC')
        ->limit(1)
        ->pluck('diagnostic')
        ->first();
    
        return view('service_infantile.acceuil.dashboard', compact('children','childnumber','consultationnumber','mostCommonDiagnostic'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $child = new Child();
        return view('service_infantile.acceuil.form', compact('child'));
    }

    public function search(Request $request)
    {
        $query = $request->input('nom');
        $children = Child::where('nom', 'LIKE', "%{$query}%")->get();
        return view('service_infantile.acceuil.index', compact('children'));
    }

    public function downloadQRCode($id)
    {
        $child = Child::findOrFail($id);
        $qrContent = "Nom: {$child->nom}\nDate de naissance: {$child->date_naissance}\nSexe: {$child->sexe}\nAge: {$child->age}\nPhone: {$child->phone}\nTel Père: {$child->tel_pere}\nTel mère: {$child->tel_mere}";
        $qrCode = QrCode::format('png')->size(200)->generate($qrContent);
        $fileName = "{$child->nom}_qrcode.png";
        $filePath = storage_path("app/public/{$fileName}");
        file_put_contents($filePath, $qrCode);
        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'departement' => 'required|string|max:255',
            'quartier' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'sexe' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'commune' => 'required|string|max:255',
            'phone' => 'required|string',
            'nom_pere' => 'required|string|max:255',
            'profession_pere' => 'required|string|max:255',
            'age_pere' => 'required|numeric',
            'adresse_pere' => 'required|string|max:255',
            'tel_pere' => 'required|string',
            'nom_mere' => 'required|string|max:255',
            'profession_mere' => 'required|string|max:255',
            'age_mere' => 'required|numeric',
            'adresse_mere' => 'required|string|max:255',
            'tel_mere' => 'required|string',
            
        ]);

        $child = new Child();

        $child->nom = $request->nom;
        $child->date_naissance = $request->date_naissance;
        $child->departement = $request->departement;
        $child->quartier = $request->quartier;
        $child->adresse = $request->adresse;
        $child->sexe = $request->sexe;
        $child->profession = $request->profession;
        $child->commune = $request->commune;
        $child->phone = $request->phone;
        $child->nom_pere = $request->nom_pere;
        $child->profession_pere = $request->profession_pere;
        $child->age_pere = $request->age_pere;
        $child->adresse_pere = $request->adresse_pere;
        $child->tel_pere = $request->tel_pere;
        $child->nom_mere = $request->nom_mere;
        $child->profession_mere = $request->profession_mere;
        $child->age_mere = $request->age_mere;
        $child->adresse_mere = $request->adresse_mere;
        $child->tel_mere = $request->tel_mere;

        $child->save();

        return redirect()->route('Service_Infantile.child.index')->with('status', 'Enregistrement effectué');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $child = Child::findOrFail($id);
        return view('child.show', compact('child'));
    }

    public function attachUser(Request $request, Child $child)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

       $child->users()->attach($request->user_id, ['created_at' => now(), 'updated_at' => now()]);

        return redirect()->route('Service_Infantile.child.index')->with('status', 'Médecin affecté');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $child = Child::find($id);
        return view('service_infantile.acceuil.form', compact('child'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Child $child)
    {
        $request->validate([
            'nom' => 'nullable|string|max:255',
            'date_naissance' => 'nullable|date',
            'departement' => 'nullable|string|max:255',
            'quartier' => 'nullable|string|max:255',
            'adresse' => 'nullable|string|max:255',
            'sexe' => 'nullable|string|max:255|in:male,female,other',
            'profession' => 'nullable|string|max:255',
            'commune' => 'nullable|string|max:255',
            'phone' => 'nullable|digits_between:8,15',
            'nom_pere' => 'nullable|string|max:255',
            'profession_pere' => 'nullable|string|max:255',
            'age_pere' => 'nullable|integer|min:0',
            'adresse_pere' => 'nullable|string|max:255',
            'tel_pere' => 'nullable|digits_between:8,15',
            'nom_mere' => 'nullable|string|max:255',
            'profession_mere' => 'nullable|string|max:255',
            'age_mere' => 'nullable|integer|min:0',
            'adresse_mere' => 'nullable|string|max:255',
            'tel_mere' => 'nullable|digits_between:8,15'
        ]);

        $child->nom = $request->filled('nom') ? $request->nom : $child->nom;
        $child->date_naissance = $request->filled('date_naissance') ? $request->date_naissance : $child->date_naissance;
        $child->departement = $request->filled('departement') ? $request->departement : $child->departement;
        $child->quartier = $request->filled('quartier') ? $request->quartier : $child->quartier;
        $child->adresse = $request->filled('adresse') ? $request->adresse : $child->adresse;
        $child->sexe = $request->filled('sexe') ? $request->sexe : $child->sexe;
        $child->profession = $request->filled('profession') ? $request->profession : $child->profession;
        $child->commune = $request->filled('commune') ? $request->commune : $child->commune;
        $child->phone = $request->filled('phone') ? $request->phone : $child->phone;
        $child->nom_pere = $request->filled('nom_pere') ? $request->nom_pere : $child->nom_pere;
        $child->profession_pere = $request->filled('profession_pere') ? $request->profession_pere : $child->profession_pere;
        $child->age_pere = $request->filled('age_pere') ? $request->age_pere : $child->age_pere;
        $child->adresse_pere = $request->filled('adresse_pere') ? $request->adresse_pere : $child->adresse_pere;
        $child->tel_pere = $request->filled('tel_pere') ? $request->tel_pere : $child->tel_pere;
        $child->nom_mere = $request->filled('nom_mere') ? $request->nom_mere : $child->nom_mere;
        $child->profession_mere = $request->filled('profession_mere') ? $request->profession_mere : $child->profession_mere;
        $child->age_mere = $request->filled('age_mere') ? $request->age_mere : $child->age_mere;
        $child->adresse_mere = $request->filled('adresse_mere') ? $request->adresse_mere : $child->adresse_mere;
        $child->tel_mere = $request->filled('tel_mere') ? $request->tel_mere : $child->tel_mere;

        $child->update();

        return redirect()->route('Service_Infantile.child.index')->with('status', 'Enregistrement modifié');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Child::find($id)->delete();
        return redirect()->route('Service_Infantile.child.index')->with('status', 'Enregistrement supprimé');
    }
}
