<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SymptomMapping;
use App\Models\SymptomLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SymptomAnalyzerController extends Controller
{
    public function index()
    {
        return view('patient.symptoms.index');
    }

    public function analyze(Request $request)
    {
        $request->validate(['symptoms' => 'required|string']);
        $symptomsStr = strtolower($request->symptoms);
        $symptomsArr = array_map('trim', explode(',', $symptomsStr));

        $matchedSpecializations = [];
        $mappings = SymptomMapping::all();

        foreach ($symptomsArr as $symptom) {
            foreach ($mappings as $mapping) {
                if (str_contains($symptom, strtolower($mapping->keyword))) {
                    $matchedSpecializations[] = $mapping->specialization;
                }
            }
        }

        $matchedSpecializations = array_unique($matchedSpecializations);

        // default if no match
        if (empty($matchedSpecializations)) {
            $matchedSpecializations[] = 'General Physician';
        }

        SymptomLog::create([
            'patient_id' => Auth::id(),
            'symptoms' => $request->symptoms,
            'recommended_specializations' => json_encode($matchedSpecializations),
        ]);

        $doctors = User::where('role', 'doctor')
            ->whereIn('specialty', $matchedSpecializations)->get();

        return view('patient.symptoms.results', compact('matchedSpecializations', 'doctors', 'symptomsStr'));
    }
}
