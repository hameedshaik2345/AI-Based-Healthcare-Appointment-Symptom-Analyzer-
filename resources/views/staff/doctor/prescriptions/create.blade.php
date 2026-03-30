<x-layouts.doctor>
    <div class="container py-4">
        <h3 class="mb-4">Write Prescription for {{ $appointment->patient->name }}</h3>

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('doctor.appointments.prescription.store', $appointment->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Medicine</label>
                        <div id="medicine-list">
                            <input type="text" name="medicines[]" class="form-control mb-2"
                                placeholder="Medicine Name & Dosage" required>
                        </div>
                        <button type="button" class="btn btn-sm btn-secondary" onclick="addMedicine()">+ Add More
                            Medicine</button>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit Prescription</button>
                    <a href="{{ route('doctor.appointments.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function addMedicine() {
                let list = document.getElementById('medicine-list');
                let input = document.createElement('input');
                input.type = 'text';
                input.name = 'medicines[]';
                input.className = 'form-control mb-2';
                input.placeholder = 'Medicine Name & Dosage';
                input.required = true;
                list.appendChild(input);
            }
        </script>
    @endpush
</x-layouts.doctor>