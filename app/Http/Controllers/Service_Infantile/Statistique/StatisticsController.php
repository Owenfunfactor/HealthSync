<?php
namespace App\Http\Controllers\Service_Infantile\Statistique;

use App\Http\Controllers\Controller;
use App\Models\Child;
use App\Models\Consultation_pediatrie;
use Carbon\Carbon;
use Illuminate\Http\Request;


class StatisticsController extends Controller
{
    public function getDailyStats()
    {
        // Obtenir les données pour les enfants
        $childrenData = Child::selectRaw('DAY(created_at) as day, COUNT(*) as count')
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        // Obtenir les données pour les consultations
        $consultationData = Consultation_pediatrie::selectRaw('DAY(created_at) as day, COUNT(*) as count')
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $daysInMonth = Carbon::now()->daysInMonth;

        // Initialiser les tableaux pour les enfants et les consultations
        $childStats = [];
        $consultationStats = [];

        for ($i = 1; $i <= $daysInMonth; $i++) {
            $childStats[$i] = 0; // Initialiser chaque jour à 0 pour les enfants
            $consultationStats[$i] = 0; // Initialiser chaque jour à 0 pour les consultations
        }

        foreach ($childrenData as $item) {
            $childStats[$item->day] = $item->count;
        }

        foreach ($consultationData as $item) {
            $consultationStats[$item->day] = $item->count;
        }

        // Reformater les données pour JSON
        $formattedData = [];
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $formattedData[] = [
                'day' => $day,
                'child_count' => $childStats[$day],
                'consultation_count' => $consultationStats[$day],
            ];
        }

        return response()->json($formattedData);
    }
}
