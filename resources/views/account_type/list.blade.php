@extends('layouts.app')

@section('title', 'List Account Type')

@section('content')

    <br><br>

    <div class="container">

        <h3>List Account Type</h3><br>

        <a href="{{ route('addAccountType') }}" class="btn btn-success">Add New</a><br><br>

        <div class="row">
            <div class="col-md-12">

                <div id="message"></div>

                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($accountTypes as $accountType)
                            <tr>
                                <td>{{ $accountType->account_name }}</td>
                                <td>
                                    <a href="{{ route('editAccountType', $accountType->account_id) }}"><img
                                            src="{{ asset('images/edit.png') }}"></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">No records found!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        // alert success for add account type
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

        // alert success for update account type
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
