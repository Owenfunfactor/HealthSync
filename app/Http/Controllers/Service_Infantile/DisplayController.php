<?php

namespace App\Http\Controllers\Service_Infantile;

use App\Http\Controllers\Controller;
use App\Models\Consultation_pediatrie;
use App\Models\User;
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    public function getMedecins(Request $request)
    {
        // Récupérer le paramètre de requête 'department'
        $department = $request->query('department');

        // Récupérer les médecins correspondant au département
        $medecins = User::where('departement', $department)
                         ->get();

        // Retourner les médecins en format JSON
        return response()->json($medecins);
    }

    public function getAllInfirmiers()
    {
        $infirmiers = User::where('type_compte', 'infirmier')->get();
        return response()->json($infirmiers);
    }

    public function attachInfirmerie(Request $request, Consultation_pediatrie $consultation)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $consultation->users()->attach($request->user_id, ['created_at' => now(), 'updated_at' => now()]);

        return back()->with('status', 'Personnel affecté');
    }
}
