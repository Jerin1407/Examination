@extends('layouts.app')

@section('title', 'List Exam')

@section('content')

    <div class="container">

        <h3>List Exam</h3>

        <div class="row">
            <div class="col-lg-6">
                <form method="post" action="">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search...">
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
                        <a href="">
                            Active Exam
                        </a>
                    </div>
                    <div class="card-body">
                        1
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header" style="background:#eeeeee;">
                        <a href="">
                            Upcoming Exam
                        </a>
                    </div>
                    <div class="card-body">
                        2
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header" style="background:#eeeeee;">
                        <a href="">
                            Archived Exam
                        </a>
                    </div>
                    <div class="card-body">
                        3
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

                    {{-- <tr>
                        <td colspan="3">No records found</td>
                    </tr> --}}

                    <tr>
                        <td>1</td>
                        <td>Exam 1</td>
                        <td>10</td>
                        <td>
                            <a href="" class="btn btn-success">Attempt</a>
                            <a href="#" class="btn btn-warning">Expired</a>
                            <a href="#" class="btn btn-default">Upcoming</a>
                            <a href="" class="btn btn-primary">
                                paynow
                            </a>

                            <a href=""><img src="{{ asset('images/edit.png') }}"></a>

                            <a href="">
                                <img src="{{ asset('images/cross.png') }}">
                            </a>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
        <br><br>

        <a href="" class="btn btn-primary">Back</a>
        &nbsp;&nbsp;
        <a href="" class="btn btn-primary">Next</a>

    </div>

@endsection
