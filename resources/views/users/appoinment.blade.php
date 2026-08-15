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

                    {{-- <tr>
                            <td colspan="6">No record found</td>
                        </tr> --}}

                    <tr>
                        <td>1</td>
                        <td>
                            Admin
                            <br>Skype ID :
                        </td>
                        <td>
                            Admin
                            <br>Skype ID:
                        </td>
                        <td>2019-03-18 11:48:40</td>
                        <td>
                            Accepted

                            <a href="" class="btn btn-success btn-sm">accept</a>

                            <a href="" class="btn btn-danger btn-sm">reject</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <a href="" class="btn btn-primary">Back</a>
        &nbsp;&nbsp;
        <a href="" class="btn btn-primary">Next</a>

    </div>
@endsection
