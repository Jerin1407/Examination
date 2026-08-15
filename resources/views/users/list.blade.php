@extends('layouts.app')

@section('title', 'List User')

@section('content')

    <div class="container">

        <h3>List User</h3>

        <div class="row">
            <div class="col-lg-6">
                <form method="post" action="">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="search...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <br>

                <table class="table table-bordered">
                    <tr>
                        <th>SI.No</th>
                        <th>Email</th>
                        <th>Full Name</th>
                        <th>Account Status</th>
                        <th>Send New Notification</th>
                        <th>Action</th>
                    </tr>

                    {{-- <tr>
                            <td colspan="3">No record found</td>
                        </tr> --}}

                    <tr>
                        <td>1</td>
                        <td>miller@domain.com</td>
                        <td>John Doe</td>
                        <td>Active</td>
                        <td>
                            <a href="">send new notification</a>
                        </td>
                        <td>
                            <a href=""><i class="fa fa-eye" title="View Profile"></i></a>

                            <a href=""><img src="{{ asset('images/edit.png') }}"></a>

                            <a href="">
                                <img src="{{ asset('images/cross.png') }}">
                            </a>
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
