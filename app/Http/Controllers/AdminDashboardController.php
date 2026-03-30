<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Stats Cards Data
        $totalPatients = User::where('role', 'patient')->count();
        $totalDoctors = User::where('role', 'doctor')->count();
        $appointmentsToday = Appointment::whereDate('appointment_date', Carbon::today())
            ->where('status', '!=', 'cancelled')
            ->count();
        $pendingAppointments = Appointment::where('status', 'scheduled')->count();
        $totalRevenue = \App\Models\Bill::sum('total_amount');

        $doctorStats = Appointment::select('doctor_id', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->groupBy('doctor_id')
            ->with('doctor')
            ->get();

        // Recent Registrations (Last 5 users)
        $recentUsers = User::latest()->take(5)->get();

        // Upcoming Appointments (Next 5 across the system)
        $upcomingAppointments = Appointment::with(['patient', 'doctor'])
            ->where('appointment_date', '>', Carbon::now())
            ->whereIn('status', ['scheduled', 'confirmed'])
            ->orderBy('appointment_date', 'asc')
            ->take(5)
            ->get();

        return view('staff.admin.dashboard', compact(
            'totalPatients',
            'totalDoctors',
            'appointmentsToday',
            'pendingAppointments',
            'totalRevenue',
            'doctorStats',
            'recentUsers',
            'upcomingAppointments'
        ));
    }
}