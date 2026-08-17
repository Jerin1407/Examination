@extends('layouts.app')

@section('title', 'List Mark')

@section('content')

    <div class="container">

        <div class="container">
            <h3>List Mark</h3><br><br>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">

                        <form method="post" action="">
                            @csrf
                            <select name="quid">
                                <option value="0">All Exam</option>
                                <option value="">All Exam</option>
                            </select>
                            <br><br>

                            <select name="status" id="status">
                                <option value="0">Pending</option>
                                <option value="1">Completed</option>
                            </select>
                            <br><br>

                            <button class="btn btn-default" type="submit">Filter</button>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail" class="sr-only">{{ __('lang.quiz_name') }}</label>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <br>

                <table class="table table-bordered">
                    <tr>
                        <th>SI.No</th>
                        <th>Name</th>
                        <th>Exam Name</th>
                        <th>Mark</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                    {{-- <tr>
                        <td colspan="3">No records found</td>
                    </tr> --}}

                    <tr>
                        <td>1</td>
                        <td>Admin</td>
                        <td>Exam - 1</td>
                        <td>20</td>
                        <td>Pending</td>
                        <td>
                            <a href="" class="btn btn-success" target="_blank">View</a>
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
