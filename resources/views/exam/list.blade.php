@extends('layouts.app')

@section('title', 'List Exam')

@section('content')

    <div class="container">

        <h3>List Exam</h3>

        <div class="row">
            <div class="col-lg-6">
                <form method="get" action="{{ route('listExam') }}">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search..."
                            value="{{ request('search') }}">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
            <div class="col-lg-6">
                <p style="float:right;"></p>
            </div>
        </div>

        <br>

        <div class="row">

            <div class="col-lg-4">
                <div class="card mb-4 {{ $status === 'active' ? 'border-success' : '' }}">
                    <div class="card-header" style="background:#eeeeee;">
                        <a href="{{ route('listExam', ['status' => 'active']) }}">
                            Active Exam
                        </a>
                    </div>
                    <div class="card-body">
                        {{ $activeCount }}
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-4 {{ $status === 'upcoming' ? 'border-success' : '' }}">
                    <div class="card-header" style="background:#eeeeee;">
                        <a href="{{ route('listExam', ['status' => 'upcoming']) }}">
                            Upcoming Exam
                        </a>
                    </div>
                    <div class="card-body">
                        {{ $upcomingCount }}
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-4 {{ $status === 'archived' ? 'border-success' : '' }}">
                    <div class="card-header" style="background:#eeeeee;">
                        <a href="{{ route('listExam', ['status' => 'archived']) }}">
                            Archived Exam
                        </a>
                    </div>
                    <div class="card-body">
                        {{ $archivedCount }}
                    </div>
                </div>
            </div>

        </div>

        @if ($status)
            <p>
                Showing: <strong>{{ ucfirst($status) }}</strong> exams
                <a href="{{ route('listExam') }}" class="btn btn-sm btn-default">Clear filter</a>
            </p>
        @endif

        <div class="row">
            <div class="col-md-12">
                <br>

                <table class="table table-bordered">
                    <tr>
                        <th>SI.No</th>
                        <th>Exam Name</th>
                        <th>No. of Questions</th>
                        <th>Action</th>
                    </tr>

                    @forelse ($exams as $index => $exam)
                        @php
                            $today = \Carbon\Carbon::now();
                            $start = \Carbon\Carbon::createFromTimestamp($exam->start_date);
                            $end = \Carbon\Carbon::createFromTimestamp($exam->end_date);

                            if ($today->lt($start)) {
                                $rowStatus = 'upcoming';
                            } elseif ($today->gt($end)) {
                                $rowStatus = 'expired';
                            } else {
                                $rowStatus = 'active';
                            }
                        @endphp
                        <tr>
                            <td>{{ $exams->firstItem() + $index }}</td>
                            <td>{{ $exam->quiz_name }}</td>
                            <td>{{ $exam->noq }}</td>
                            <td>
                                @if ($rowStatus === 'active')
                                    <a href="{{ route('attemptExam') }}" class="btn btn-success">Attempt</a>
                                @elseif ($rowStatus === 'expired')
                                    <a href="#" class="btn btn-warning disabled">Expired</a>
                                @else
                                    <a href="#" class="btn btn-default disabled">Upcoming</a>
                                @endif

                                @if ($exam->quiz_price > 0)
                                    <a href="" class="btn btn-primary">
                                        Pay Now
                                    </a>
                                @endif

                                <a href="{{ route('editExam', $exam->quid) }}">
                                    <img src="{{ asset('images/edit.png') }}">
                                </a>

                                <form action="{{ route('deleteExam', $exam->quid) }}" method="POST" class="d-inline m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="delete-btn border-0 bg-transparent p-0">
                                        <img src="{{ asset('images/cross.png') }}" style="width:16px; height:16px;">
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No records found!</td>
                        </tr>
                    @endforelse
                </table>

            </div>
        </div>
        <br><br>

        @if ($exams->previousPageUrl())
            <a href="{{ $exams->previousPageUrl() }}" class="btn btn-primary">Back</a>
        @else
            <a href="#" class="btn btn-primary disabled">Back</a>
        @endif
        &nbsp;&nbsp;
        @if ($exams->nextPageUrl())
            <a href="{{ $exams->nextPageUrl() }}" class="btn btn-primary">Next</a>
        @else
            <a href="#" class="btn btn-primary disabled">Next</a>
        @endif

    </div>

    <script>
        // alert success for add exam
        @if (session('success_add'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#10B981', // green color
                color: '#fff',
                iconColor: '#fff',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            Toast.fire({
                icon: 'success',
                title: '{{ session('success_add') }}'
            });
        @endif

        // alert success for update exam
        @if (session('success_update'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#10B981', // green color
                color: '#fff',
                iconColor: '#fff',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            Toast.fire({
                icon: 'success',
                title: '{{ session('success_update') }}'
            });
        @endif

        // Delete Alert
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                let form = this.closest('form');

                Swal.fire({
                    position: 'top',
                    title: 'Are you sure?',
                    text: 'You want to delete this exam?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete!',
                    cancelButtonText: 'Cancel',
                    width: '380px',
                    toast: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Success Alert
        @if (session('success_delete'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                background: '#10B981', // green color
                color: '#fff',
                iconColor: '#fff',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            Toast.fire({
                icon: 'success',
                title: '{{ session('success_delete') }}'
            });
        @endif
    </script>

@endsection
