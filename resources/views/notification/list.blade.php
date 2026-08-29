@extends('layouts.app')

@section('title', 'List Notification')

@section('content')

    <div class="container">

        <h3>List Notification</h3>

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
        </div>

        <div class="row">
            <div class="col-md-12">
                <br>

                <a href="{{ route('addNotification') }}" class="btn btn-success">Add New</a><br><br>

                <table class="table table-bordered">
                    <tr>
                        <th>SI.No</th>
                        <th>Title</th>
                        <th>Message</th>
                        <th>Click Action</th>
                        <th>Notification To</th>
                        <th>Date</th>
                    </tr>

                    {{-- <tr>
                        <td colspan="6">No records found!</td>
                    </tr> --}}

                    <tr>
                        <td>1</td>
                        <td><a href="" target="fcmclick">Developer</a></td>
                        <td>Hello</td>
                        <td>https..</td>
                        <td>All users</td>
                        <td>22-08-2026</td>
                    </tr>
                </table>
            </div>
        </div>

        <a href="" class="btn btn-primary">Back</a>
        &nbsp;&nbsp;
        <a href="" class="btn btn-primary">Next</a>

    </div>

@endsection
