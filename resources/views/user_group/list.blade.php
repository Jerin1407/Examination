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
                                <div class="d-flex align-items-center" style="gap: 10px;">
                                    <a href="{{ route('editUserGroup', $group->gid) }}"><img
                                            src="{{ asset('images/edit.png') }}"></a>

                                    <form action="{{ route('deleteUserGroup', $group->gid) }}" method="POST"
                                        class="d-inline m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="delete-btn border-0 bg-transparent p-0">
                                            <img src="{{ asset('images/cross.png') }}" style="width:16px; height:16px;">
                                        </button>
                                    </form>
                                </div>
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

        // Delete Alert
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                let form = this.closest('form');

                Swal.fire({
                    position: 'top',
                    title: 'Are you sure?',
                    text: 'You want to delete this user group?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete!',
                    cancelButtonText: 'Cancel',
                    width: '380px',
                    toast: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Success Alert
        @if (session('success_delete'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
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
                title: '{{ session('success_delete') }}'
            });
        @endif
    </script>

@endsection
