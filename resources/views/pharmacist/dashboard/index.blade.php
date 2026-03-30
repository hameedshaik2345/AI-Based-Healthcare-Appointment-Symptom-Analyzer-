<x-layouts.pharmacist>
    <div class="container py-4">
        <h2 class="h3 fw-bold mb-4">Lookup Patient Prescription</h2>

        @if(session('success'))
            <div class="alert alert-success mt-3"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
        @endif

        <!-- Search Medicine by Token & Doctor -->
        <div class="card shadow-sm border-0 mb-5 p-4" style="border-radius: 15px;">
            <form action="{{ route('pharmacist.dashboard') }}" method="GET">
                <div class="row align-items-end g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Token Number</label>
                        <input type="number" name="token_number" value="{{ request('token_number') }}"
                            class="form-control form-control-lg" placeholder="Enter Patient Token" required>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label fw-bold">Select Doctor</label>
                        <select name="doctor_id" class="form-select form-select-lg" required>
                            <option value="">-- Select Doctor --</option>
                            @foreach($doctors as $doc)
                                <option value="{{ $doc->id }}" {{ request('doctor_id') == $doc->id ? 'selected' : '' }}>
                                    Dr. {{ $doc->name }} ({{ $doc->doctorProfile->specialty ?? 'Specialist' }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-lg btn-primary w-100"><i class="bi bi-search"></i> Find
                            Prescription</button>
                    </div>
                </div>
            </form>
        </div>

        @if(request('token_number') && request('doctor_id'))
            @if($prescription)
                <div class="card border-0 shadow-lg" style="border-radius: 15px; border-top: 5px solid #00B4A6 !important;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="fw-bold mb-0 text-success">Prescription Verified!</h4>
                            <span class="badge bg-secondary fs-6">Prescription #{{ $prescription->id }}</span>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <p class="text-muted mb-1">Patient Name</p>
                                <h5 class="fw-bold">{{ $prescription->patient->name }}</h5>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted mb-1">Prescribed By</p>
                                <h5 class="fw-bold">Dr. {{ $prescription->doctor->name }}</h5>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted mb-1">Status</p>
                                <h5 class="fw-bold text-warning text-uppercase">{{ $prescription->status }}</h5>
                            </div>
                        </div>

                        <h5 class="fw-bold mb-3 border-bottom pb-2">Medicines Prescribed:</h5>
                        <div class="row g-3 mb-4">
                            @foreach(json_decode($prescription->medicines, true) ?? [] as $med)
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded border border-info">
                                        <i class="bi bi-capsule text-primary"></i> <strong>{{ $med }}</strong>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if($prescription->notes)
                            <p><strong>Doctor Notes:</strong> {{ $prescription->notes }}</p>
                        @endif

                        <hr class="my-4">
                        <h5 class="fw-bold text-primary mb-3">Generate Bill & Release Medicines</h5>
                        <form action="{{ route('pharmacist.prescriptions.bill.store', $prescription->id) }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-5">
                                    <label class="fw-bold">Consultation Fee ($)</label>
                                    <input type="number" step="0.01" name="consultation_fee"
                                        class="form-control form-control-lg bg-light" value="50.00" required>
                                </div>
                                <div class="col-md-5">
                                    <label class="fw-bold">Total Medicine Cost ($)</label>
                                    <input type="number" step="0.01" name="medicine_cost"
                                        class="form-control form-control-lg border-primary"
                                        placeholder="Calculate & Enter total cost" required>
                                </div>
                                <div class="col-md-2 mt-auto">
                                    <button class="btn btn-lg btn-success w-100" type="submit">Print & Pay</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="alert alert-danger p-4 text-center rounded border-0 shadow-sm">
                    <i class="bi bi-exclamation-triangle-fill fs-1"></i><br>
                    <strong>No pending prescription found!</strong><br>
                    Please verify the Patient's Token Number and Doctor, or check if the bill was already generated.
                </div>
            @endif
        @else
            <div class="text-center text-muted my-5 py-5">
                <i class="bi bi-search" style="font-size: 4rem; opacity: 0.2;"></i>
                <h5 class="mt-3">Enter Token Number and Select Doctor to begin.</h5>
            </div>
        @endif
    </div>
</x-layouts.pharmacist>