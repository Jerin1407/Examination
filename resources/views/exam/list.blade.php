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
                                    <a href="" class="btn btn-success">Attempt</a>
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

                                <a href="">
                                    <img src="{{ asset('images/edit.png') }}">
                                </a>

                                <a href="" onclick="return confirm('Are you sure you want to delete this exam?');">
                                    <img src="{{ asset('images/cross.png') }}">
                                </a>
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

@endsection
