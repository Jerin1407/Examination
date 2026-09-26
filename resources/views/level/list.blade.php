@extends('layouts.app')

@section('title', 'List Level')

@section('content')

    <div class="container">

        <h3>List Level</h3>

        <div class="row">
            <div class="col-md-12">
                <br>

                <div id="message"></div>

                {{-- <form method="post" action="">
                    @csrf

                    <table class="table table-bordered">
                        <tr>
                            <th>Level Name</th>
                            <th>Action</th>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" class="form-control" name="level_name" value=""
                                    placeholder="Level Name" required>
                            </td>
                            <td>
                                <button class="btn btn-default" type="submit">Add New</button>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" class="form-control" value="">
                            </td>
                            <td>
                                <a href=""><img src="{{ asset('images/cross.png') }}"></a>
                            </td>
                        </tr>

                    </table>
                </form> --}}

                <table class="table table-bordered">
                    <tr>
                        <th>Level Name</th>
                        <th>Action</th>
                    </tr>

                    <form method="post" action="{{ route('saveLevel') }}">
                        @csrf
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="level_name" value=""
                                    placeholder="Level Name" required>
                            </td>
                            <td>
                                <button class="btn btn-default" type="submit">Add New</button>
                            </td>
                        </tr>
                    </form>

                    @forelse ($levels as $level)
                        <tr>
                            <td>
                                <form method="post" action="{{ route('updateLevel', $level->lid) }}" class="form-inline">
                                    @csrf
                                    <input type="text" class="form-control" name="level_name"
                                        value="{{ $level->level_name }}" required style="display:inline-block; width:80%;">
                            </td>
                            <td>
                                <button class="btn btn-default btn-sm" type="submit">Save</button>
                                </form>

                                <form action="{{ route('deleteLevel', $level->lid) }}" method="POST" class="d-inline m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="delete-btn border-0 bg-transparent p-0">
                                        <img src="{{ asset('images/cross.png') }}">
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">No record found!</td>
                        </tr>
                    @endforelse

                </table>
            </div>
        </div>

    </div>

    <script>
        // alert success for add level
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

        // alert success for update level
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
                    text: 'You want to delete this level?',
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
