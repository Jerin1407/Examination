@extends('layouts.app')

@section('title', 'List User Group')

@section('content')

    <div class="container">

        <h3>List User Group</h3>

        <div class="row">
            <div class="col-md-12">
                <br>

                <div id="message"></div>

                <a href="{{ route('addUserGroup') }}" class="btn btn-success">Add New</a>

                <table class="table table-bordered">
                    <tr>
                        <th>Group Name</th>
                        <th>Price (numeric only)</th>
                        <th>Valid for days, 0 = unlimited</th>
                        <th>Action</th>
                    </tr>

                    {{-- <tr>
                        <td colspan="3">No records found!</td>
                    </tr> --}}

                    <tr>
                        <td>admin</td>
                        <td>$ 0 USD</td>
                        <td>0</td>
                        <td>
                            <a href="{{ route('editUserGroup') }}"><img src="{{ asset('images/edit.png') }}"></a>

                            <a href=""><img src="{{ asset('images/cross.png') }}"></a>
                        </td>
                    </tr>
                </table>

            </div>
        </div>

    </div>

@endsection
