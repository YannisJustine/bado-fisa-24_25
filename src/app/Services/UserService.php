<?php

namespace App\Services;

use App\Http\Helper;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;


class UserService
{

    /**
     * Check if the formateur is available for the given hours (Doesn't have other lessons at the same time)
     */
    public function checkFormateurLeconAvailability(string $start, string $end, Collection $collection)
    {
        $available = true;
        foreach ($collection as $item) {
            if(Helper::intervalIntersect($item->heure_debut, $item->heure_fin, $start, $end))
            {
                $available = false;
            }
        }

        return $available;
    }


    /**
     * Generate the continuous intervals for the given creneaux and day.
     */
    private function generateContinuousIntervals(Collection $creneaux) {
        $creneaux->sortBy('jour_semaine');
        $currentDay = -1;
        
        $currentContinuousInterval = null;
        $continuousIntervals = [];

        foreach ($creneaux as $interval) {
            if ($interval['jour_semaine'] !== $currentDay) {
                if ($currentContinuousInterval) {
                    $continuousIntervals[] = $currentContinuousInterval;
                }
                $currentDay = $interval['jour_semaine'];
                $currentContinuousInterval = [
                    'jour_semaine' => [$currentDay],
                    'heure_debut' => $interval['heure_debut'],
                    'heure_fin' => $interval['heure_fin'],
                ];
            } else {
                if ($interval['heure_debut'] == $currentContinuousInterval['heure_fin']) {
                    $currentContinuousInterval['heure_fin'] = $interval['heure_fin'];
                } else {
                    $continuousIntervals[] = $currentContinuousInterval;
                    $currentContinuousInterval = [
                        'jour_semaine' => [$currentDay],
                        'heure_debut' => $interval['heure_debut'],
                        'heure_fin' => $interval['heure_fin'],
                    ];
                }
            }
        }

        if ($currentContinuousInterval) {
            $continuousIntervals[] = $currentContinuousInterval;
        }

        return $continuousIntervals;
    }

    // Check if the formateur work at the given hours
    public function hasContinuousIntervalForHour($start, $end, $formateur, $jourSemaine) {
        $continuousIntervals = $this->generateContinuousIntervals($formateur->creneaux->where('jour_semaine', $jourSemaine));
        $isAvailable = false;
        foreach($continuousIntervals as $continuousInterval) {

            if($start >= $continuousInterval['heure_debut'] && $end <= $continuousInterval['heure_fin']) {
                $isAvailable = true;
                break;
            }
        }

        return $isAvailable;
    }

    public function hasTypePermis(int $formateurId, int $typePermisId) {
        return User::where("id", $formateurId)
                ->whereHas('typePermis', function($query) use($typePermisId) {
                    $query->where('id', $typePermisId);
                })
                ->exists();
    }
}
