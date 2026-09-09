@extends('layouts.app')

@section('title', 'Appointments')

@section('content')

    <div class="container">

        <h3>My Appointments</h3>

        <div class="row">
            <div class="col-md-12">
                <br>

                <table class="table table-bordered">
                    <tr>
                        <th>SI.No</th>
                        <th>Requested By</th>
                        <th>Appointment With</th>
                        <th>Appointment Time</th>
                        <th>Status</th>
                    </tr>

                    @forelse ($appointments as $index => $appointment)
                        <tr>
                            <td>{{ $appointments->firstItem() + $index }}</td>
                            <td>
                                {{ $appointment->requester_first_name }} {{ $appointment->requester_last_name }}
                                <br>Skype ID: {{ $appointment->requester_skype }}
                            </td>
                            <td>
                                {{ $appointment->recipient_first_name }} {{ $appointment->recipient_last_name }}
                                <br>Skype ID: {{ $appointment->recipient_skype }}
                            </td>
                            <td>{{ $appointment->appointment_timing }}</td>
                            <td>
                                {{ $appointment->appointment_status }}

                                @if ($appointment->appointment_status == 'Pending')
                                    <a href="" class="btn btn-success btn-sm">accept</a>

                                    <a href="" class="btn btn-danger btn-sm">reject</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No record found</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>

        @if ($appointments->previousPageUrl())
            <a href="{{ $appointments->previousPageUrl() }}" class="btn btn-primary">Back</a>
        @else
            <a href="#" class="btn btn-primary disabled">Back</a>
        @endif
        &nbsp;&nbsp;
        @if ($appointments->nextPageUrl())
            <a href="{{ $appointments->nextPageUrl() }}" class="btn btn-primary">Next</a>
        @else
            <a href="#" class="btn btn-primary disabled">Next</a>
        @endif

    </div>
@endsection
