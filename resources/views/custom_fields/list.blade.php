@extends('layouts.app')

@section('title', 'Custom Registration Fields')

@section('content')

    <br><br>

    <div class="container">

        <h3>List Custom Registration Fields</h3><br>

        <a href="{{ route('addCustomFields') }}" class="btn btn-success">Add New</a><br><br>

        <div class="row">
            <div class="col-md-12">

                <div id="message"></div>

                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>SI.No</th>
                            <th>Field Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($fields as $index => $field)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $field->field_title }}</td>
                                <td>
                                    <a href="{{ route('editCustomFields', $field->field_id) }}">
                                        <img src="{{ asset('images/edit.png') }}">
                                    </a>
                                    <a href="{{ route('deleteCustomFields') }}"
                                        onclick="return confirm('Are you sure you want to remove this field?');">
                                        <img src="{{ asset('images/cross.png') }}">
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No records found!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        // alert success for add custom fields
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

        // alert success for update custom fields
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
