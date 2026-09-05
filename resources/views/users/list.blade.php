@extends('layouts.app')

@section('title', 'List User')

@section('content')

    <div class="container">

        <h3>List User</h3>

        <div class="row">
            <div class="col-lg-6">
                <form method="get" action="{{ route('listUser') }}">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="search..."
                            value="{{ request('search') }}">
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

                    @forelse ($users as $index => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $index }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td>{{ $user->user_status }}</td>
                            <td>
                                <a href="">send new notification</a>
                            </td>
                            <td>
                                <a href="{{ route('viewUser', $user->uid) }}"><i class="fa fa-eye"
                                        title="View Profile"></i></a>

                                <a href="{{ route('editUser', $user->uid) }}">
                                    <img src="{{ asset('images/edit.png') }}">
                                </a>

                                <a href="" onclick="return confirm('Are you sure you want to delete this user?');">
                                    <img src="{{ asset('images/cross.png') }}">
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No record found!</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>

        @if ($users->previousPageUrl())
            <a href="{{ $users->previousPageUrl() }}" class="btn btn-primary">Back</a>
        @else
            <a href="#" class="btn btn-primary disabled">Back</a>
        @endif
        &nbsp;&nbsp;
        @if ($users->nextPageUrl())
            <a href="{{ $users->nextPageUrl() }}" class="btn btn-primary">Next</a>
        @else
            <a href="#" class="btn btn-primary disabled">Next</a>
        @endif

    </div>
@endsection
