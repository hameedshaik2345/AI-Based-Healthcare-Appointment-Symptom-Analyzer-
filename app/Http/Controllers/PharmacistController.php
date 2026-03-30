<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prescription;
use App\Models\Bill;

class PharmacistController extends Controller
{
    public function index(Request $request)
    {
        $doctors = \App\Models\User::where('role', 'doctor')->with('doctorProfile')->get();
        $prescription = null;

        if ($request->filled('token_number') && $request->filled('doctor_id')) {
            $prescription = Prescription::with(['patient', 'doctor', 'appointment'])
                ->where('doctor_id', $request->doctor_id)
                ->where('status', 'pending')
                ->whereHas('appointment', function ($q) use ($request) {
                    $q->where('token_number', $request->token_number);
                })
                ->first();
        }

        return view('pharmacist.dashboard.index', compact('doctors', 'prescription'));
    }

    public function createBill(Prescription $prescription)
    {
        return view('pharmacist.prescriptions.bill', compact('prescription'));
    }

    public function storeBill(Request $request, Prescription $prescription)
    {
        $request->validate([
            'consultation_fee' => 'required|numeric',
            'medicine_cost' => 'required|numeric',
        ]);

        $total = $request->consultation_fee + $request->medicine_cost;

        Bill::create([
            'prescription_id' => $prescription->id,
            'consultation_fee' => $request->consultation_fee,
            'medicine_cost' => $request->medicine_cost,
            'total_amount' => $total,
        ]);

        $prescription->update(['status' => 'completed']);

        return redirect()->route('pharmacist.dashboard')->with('success', 'Bill generated successfully!');
    }
}
