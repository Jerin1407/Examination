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
                <div class="card mb-4">
                    <div class="card-header" style="background:#eeeeee;">
                        <a href="">Active Exam</a>
                    </div>
                    <div class="card-body">
                        {{ $activeCount }}
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header" style="background:#eeeeee;">
                        <a href="">Upcoming Exam</a>
                    </div>
                    <div class="card-body">
                        {{ $upcomingCount }}
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header" style="background:#eeeeee;">
                        <a href="">Archived Exam</a>
                    </div>
                    <div class="card-body">
                        {{ $archivedCount }}
                    </div>
                </div>
            </div>

        </div>

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
                            $start = \Carbon\Carbon::parse($exam->start_date);
                            $end = \Carbon\Carbon::parse($exam->end_date);

                            if ($today->lt($start)) {
                                $status = 'upcoming';
                            } elseif ($today->gt($end)) {
                                $status = 'expired';
                            } else {
                                $status = 'active';
                            }
                        @endphp
                        <tr>
                            <td>{{ $exams->firstItem() + $index }}</td>
                            <td>{{ $exam->quiz_name }}</td>
                            <td>{{ $exam->noq }}</td>
                            <td>
                                @if ($status === 'active')
                                    <a href="" class="btn btn-success">Attempt</a>
                                @elseif ($status === 'expired')
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
                            <td colspan="4">No records found</td>
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
