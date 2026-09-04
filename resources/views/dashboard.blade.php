@extends('layouts.app')

@section('content')
    <div class="container">

        <div id="update_notice"></div>

        <div class="row">

            <div class="col-md-4">
                <div class="card border-left-primary shadow py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <a href="{{ route('listUser') }}">
                                        NUMBER OF USER REGISTERED
                                    </a>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $userCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-left-success shadow py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <a href="{{ route('listQuestion') }}">
                                        QUESTIONS IN QUESTION BANK
                                    </a>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $questionCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-left-warning shadow py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <a href="{{ route('listExam') }}">
                                        NUMBER OF EXAM AVAILABLE
                                    </a>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $examCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row"></div>

        <div class="row" style="margin-top:20px;">
            <div class="col-lg-7">

                <div class="row">

                    <div class="col-md-6">
                        <div class="card border-left-success shadow py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            <a href="{{ route('listUser') }}">
                                                ACTIVE USERS
                                            </a>
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $activeUserCount }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card border-left-danger shadow py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            <a href="{{ route('listUser') }}">
                                                INACTIVE USERS
                                            </a>
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $inactiveUserCount }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-ban fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- recent users -->
                <div class="card shadow py-2" style="margin-top:20px;">
                    <div class="card-heading" style="padding:5px;">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Recently Registered Users
                        </h6>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped valign-middle">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th class="text-xs-right">Full Name</th>
                                    <th class="text-xs-right">Group Name</th>
                                    <th class="text-xs-right">Contact Number</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentUsers as $user)
                                    <tr>
                                        <td>{{ $user->email }}</td>
                                        <td class="text-xs-right">{{ $user->first_name }} {{ $user->last_name }}</td>
                                        <td class="text-xs-right">{{ $user->group_name ?? '—' }}</td>
                                        <td class="text-xs-right">{{ $user->contact_no }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No records found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>

        <div class="row text-center" style="margin-top:30px;">
            {{-- "Page rendered in X seconds" notice was commented out in the
             source too — left out here. --}}
        </div>

        <script>
            update_check('5');
        </script>

    </div>
@endsection
