<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create 7 Authentic Hospitals in Mangalagiri Region
        $hospitals = [
            ['name' => 'AIIMS Mangalagiri', 'location' => 'Mangalagiri, AP', 'contact' => '08645-231123'],
            ['name' => 'NRI General Hospital', 'location' => 'Chinakakani, Mangalagiri', 'contact' => '08645-236777'],
            ['name' => 'Manipal Hospital', 'location' => 'Tadepalli, Mangalagiri Zone', 'contact' => '1800-425-2424'],
            ['name' => 'Aster Ramesh Hospital', 'location' => 'Near Mangalagiri Bypass', 'contact' => '0866-2436444'],
            ['name' => 'L.V. Prasad Eye Institute', 'location' => 'Mangalagiri Campus', 'contact' => '08645-230230'],
            ['name' => 'Vedanta Super Speciality', 'location' => 'Mangalagiri Main Road', 'contact' => '08645-242331'],
            ['name' => 'Kamineni Hospital', 'location' => 'Guntur-Mangalagiri Highway', 'contact' => '08645-212232']
        ];

        foreach ($hospitals as $h) {
            \App\Models\Hospital::firstOrCreate(['name' => $h['name']], $h);
        }

        // 2. Create Core Staff & Generic Testing Accounts
        User::firstOrCreate(['email' => 'admin@mangalagiri-health.com'], [
            'name' => 'District Health Admin',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::firstOrCreate(['email' => 'pharmacist@hospital.com'], [
            'name' => 'Pharma Ravi',
            'password' => bcrypt('password'),
            'role' => 'pharmacist',
        ]);

        User::firstOrCreate(['email' => 'patient@hospital.com'], [
            'name' => 'Hameed Shaik',
            'password' => bcrypt('password'),
            'role' => 'patient',
        ]);

        // 3. Create 7 Realistic Doctors assigned to these Hospitals
        $doctors = [
            ['email' => 'doctor1@aiims.com', 'name' => 'Dr. Sudhakar Reddy', 'specialty' => 'Cardiologist', 'hospital' => 'AIIMS Mangalagiri'],
            ['email' => 'doctor2@nri.com', 'name' => 'Dr. K. Srilatha', 'specialty' => 'Neurologist', 'hospital' => 'NRI General Hospital'],
            ['email' => 'doctor3@manipal.com', 'name' => 'Dr. V. Ramakrishna', 'specialty' => 'Orthopedic', 'hospital' => 'Manipal Hospital'],
            ['email' => 'doctor4@ramesh.com', 'name' => 'Dr. P. Venkatrao', 'specialty' => 'General Physician', 'hospital' => 'Aster Ramesh Hospital'],
            ['email' => 'doctor@hospital.com', 'name' => 'Dr. B. Anusha', 'specialty' => 'Ophthalmologist', 'hospital' => 'L.V. Prasad Eye Institute'], // main test doctor
            ['email' => 'doctor6@vedanta.com', 'name' => 'Dr. M. Srinivasa', 'specialty' => 'Dermatologist', 'hospital' => 'Vedanta Super Speciality'],
            ['email' => 'doctor7@kamineni.com', 'name' => 'Dr. Ch. Kavya', 'specialty' => 'Dentist', 'hospital' => 'Kamineni Hospital']
        ];

        foreach ($doctors as $doc) {
            $user = User::firstOrCreate(['email' => $doc['email']], [
                'name' => $doc['name'],
                'password' => bcrypt('password'),
                'role' => 'doctor',
            ]);

            // Link doctor profile to exact hospital
            \App\Models\Doctor::firstOrCreate(['user_id' => $user->id], [
                'name' => $doc['name'],
                'specialization' => $doc['specialty'],
                'hospital_name' => $doc['hospital'],
                'availability' => 'Mon-Sat 10AM-4PM',
                'fees' => 500
            ]);
        }

        // 4. Create AI Symptom Mappings Engine
        $mappings = [
            ['keyword' => 'heart', 'specialization' => 'Cardiologist'],
            ['keyword' => 'chest pain', 'specialization' => 'Cardiologist'],
            ['keyword' => 'fever', 'specialization' => 'General Physician'],
            ['keyword' => 'headache', 'specialization' => 'Neurologist'],
            ['keyword' => 'brain', 'specialization' => 'Neurologist'],
            ['keyword' => 'tooth', 'specialization' => 'Dentist'],
            ['keyword' => 'skin', 'specialization' => 'Dermatologist'],
            ['keyword' => 'bone', 'specialization' => 'Orthopedic'],
            ['keyword' => 'eye', 'specialization' => 'Ophthalmologist']
        ];

        foreach ($mappings as $map) {
            \App\Models\SymptomMapping::firstOrCreate($map);
        }
    }
}
