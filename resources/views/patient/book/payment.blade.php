<x-layouts.dashboard>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">Complete Payment</h4>
                    </div>
                    <div class="card-body">
                        <h5>Appointment Summary</h5>
                        <ul class="list-group mb-4">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Doctor
                                <span>Dr. {{ $appointment->doctor_name }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Specialty
                                <span>{{ $appointment->doctor_specialty }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Date & Time
                                <span>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y h:i A') }}</span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                Total Fee
                                <span>$100.00</span>
                            </li>
                        </ul>

                        <form action="{{ route('patient.book.pay', $appointment->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success w-100 btn-lg">Pay Now & Confirm</button>
                        </form>
                        <form action="{{ route('patient.appointments.destroy', $appointment->id) }}" method="POST"
                            class="mt-2 text-center">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link text-danger text-decoration-none">Cancel
                                Booking</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>