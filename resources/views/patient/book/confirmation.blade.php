<x-layouts.dashboard>
    <div class="text-center" style="margin-top: 15vh;">
        <svg class="mx-auto mb-4 text-success" style="width: 80px; height: 80px;" fill="none" stroke="currentColor"
            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <h2 class="h3 fw-bold">Appointment Confirmed!</h2>
        <p class="text-muted">Your payment was successful and your appointment is scheduled.</p>
        @if($appointment && $appointment->token_number)
            <div class="alert alert-success d-inline-block px-4 py-3 border border-success">
                <h4 class="mb-0">Your Token Number: <strong>{{ $appointment->token_number }}</strong></h4>
            </div>
        @endif

        <div class="mt-4">
            <a href="{{ route('patient.appointments.export.patient', session('last_booked_appointment_id')) }}"
                class="btn btn-success">
                Download Confirmation (PDF)
            </a>
            <a href="{{ route('patient.appointments.index') }}" class="btn btn-secondary">
                Go to My Appointments
            </a>
        </div>
    </div>

    <script>
        // Automatically redirect after 7 seconds
        setTimeout(function () {
            window.location.href = "{{ route('patient.appointments.index') }}";
        }, 7000);
    </script>
</x-layouts.dashboard>