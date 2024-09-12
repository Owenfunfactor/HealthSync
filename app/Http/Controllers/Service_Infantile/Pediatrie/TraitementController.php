<?php

namespace App\Http\Controllers\Service_Infantile\Pediatrie;

use App\Http\Controllers\Controller;
use App\Models\Child;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TraitementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    // Récupérer les enfants qui ont des consultations
    $children = Child::whereHas('consultation_pediatries')->orderBy('created_at', 'asc')->get()->map(function ($child) {
        $now = Carbon::now();
        $date_naissance = Carbon::parse($child->date_naissance);
        $age = $date_naissance->diff($now);
        $child->years = $age->y;
        $child->months = $age->m;
        $child->days = $age->d;
        return $child;
    });

    return view('service_infantile.pediatrie.traitement.list_patient', compact('children'));
    }

    public function list_Consultation($id)
    {
        $child = Child::find($id);
        $consultations = $child->consultation_pediatries()->orderBy('created_at','desc')->get();
        return view('service_infantile.pediatrie.traitement.list_consultation', compact('consultations','child'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
}
