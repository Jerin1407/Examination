@extends('layouts.app')

@section('title', 'List User Group')

@section('content')

    <div class="container">

        <h3>List User Group</h3>

        <div class="row">
            <div class="col-md-12">
                <br>

                <div id="message"></div>

                <a href="{{ route('addUserGroup') }}" class="btn btn-success">Add New</a><br>

                <table class="table table-bordered">
                    <tr>
                        <th>Group Name</th>
                        <th>Price (numeric only)</th>
                        <th>Valid for days, 0 = unlimited</th>
                        <th>Action</th>
                    </tr>

                    @forelse ($groups as $group)
                        <tr>
                            <td>{{ $group->group_name }}</td>
                            <td>$ {{ number_format($group->price, 2) }} USD</td>
                            <td>{{ $group->valid_for_days }}</td>
                            <td>
                                <a href="{{ route('editUserGroup', $group->gid) }}"><img src="{{ asset('images/edit.png') }}"></a>

                                <a href="{{ route('deleteUserGroup') }}"
                                    onclick="return confirm('Are you sure you want to remove this group?');">
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

    </div>

    <script>
        // alert success for add user group
        @if (session('success_add'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#10B981', // green color
                color: '#fff',
                iconColor: '#fff',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            Toast.fire({
                icon: 'success',
                title: '{{ session('success_add') }}'
            });
        @endif

        // alert success for update user group
        @if (session('success_update'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#10B981', // green color
                color: '#fff',
                iconColor: '#fff',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            Toast.fire({
                icon: 'success',
                title: '{{ session('success_update') }}'
            });
        @endif
    </script>

@endsection
