<x-layouts.dashboard>
    <div class="container py-4">
        <h2 class="fw-bold mb-3"><i class="bi bi-robot text-primary"></i> Symptom Analyzer</h2>
        <p class="text-muted">Describe your symptoms (comma separated), and our AI engine will recommend the appropriate
            specialist.</p>

        <div class="card shadow-sm border-0 mt-4" style="border-radius: 12px;">
            <div class="card-body p-4">
                <form action="{{ route('patient.symptoms.analyze') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="symptoms" class="form-label fw-bold fs-5">Your Symptoms</label>
                        <textarea name="symptoms" id="symptoms" rows="4" class="form-control form-control-lg bg-light"
                            required placeholder="e.g., headache, fever, chest pain, tooth ache"></textarea>
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary px-5"><i class="bi bi-magic"></i> Analyze
                        Symptoms</button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.dashboard>