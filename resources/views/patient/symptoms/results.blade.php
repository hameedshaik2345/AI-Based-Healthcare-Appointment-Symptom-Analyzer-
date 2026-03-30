<x-layouts.dashboard>
    <div class="container py-4">
        <h2 class="fw-bold mb-3"><i class="bi bi-robot text-primary"></i> Symptom Analyzer Results</h2>

        <div class="alert alert-info mt-4">
            <strong>Based on your symptoms:</strong> "{{ $symptomsStr }}"<br>
            <strong>We recommend the following specialists:</strong>
            {{ implode(', ', $matchedSpecializations) }}
        </div>

        <h4 class="mt-4 mb-3 fw-bold">Recommended Doctors</h4>
        @if($doctors->isEmpty())
            <div class="alert alert-warning border-0 shadow-sm"><i class="bi bi-exclamation-triangle-fill text-warning"></i>
                No doctors available for these specializations at the moment. Please check back later.</div>
        @else
            <div class="row mt-3">
                @foreach($doctors as $doctor)
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm h-100 border-0"
                            style="border-radius: 12px; transition: transform 0.2s; border-left: 4px solid #0066CC !important;">
                            <div class="card-body">
                                <h5 class="card-title fw-bold text-primary">Dr. {{ $doctor->name }}</h5>
                                <p class="card-text text-muted mb-2"><i class="bi bi-hospital"></i>
                                    {{ $doctor->doctorProfile->hospital_name ?? 'HealthCare Plus' }}</p>
                                <p class="card-text fw-bold text-dark"><i class="bi bi-heart-pulse text-danger"></i>
                                    {{ $doctor->specialty }}</p>
                                <a href="{{ route('patient.book.create.step.one', ['doctor' => $doctor->id]) }}"
                                    class="btn btn-success w-100 mt-2 rounded-pill fw-bold"><i class="bi bi-calendar-check"></i>
                                    Book Appointment</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mt-4">
            <a href="{{ route('patient.symptoms.index') }}" class="btn btn-outline-secondary rounded-pill"><i
                    class="bi bi-arrow-left"></i> Analyze Different Symptoms</a>
        </div>
    </div>
</x-layouts.dashboard>