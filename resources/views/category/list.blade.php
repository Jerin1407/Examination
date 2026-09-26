@extends('layouts.app')

@section('title', 'List Category')

@section('content')

    <div class="container">

        <h3>List Category</h3>

        <div class="row">
            <div class="col-md-12">
                <br>

                <div id="message"></div>

                <table class="table table-bordered">
                    <tr>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>

                    <form method="post" action="{{ route('saveCategory') }}">
                        @csrf
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="category_name" value=""
                                    placeholder="Category Name" required>
                            </td>
                            <td>
                                <button class="btn btn-default" type="submit">Add New</button>
                            </td>
                        </tr>
                    </form>

                    @forelse ($categories as $category)
                        <tr>
                            <td>
                                <form method="post" action="{{ route('updateCategory', $category->cid) }}"
                                    class="form-inline">
                                    @csrf
                                    <input type="text" class="form-control" name="category_name"
                                        value="{{ $category->category_name }}" required
                                        style="display:inline-block; width:80%;">
                            </td>
                            <td>
                                <button class="btn btn-default btn-sm" type="submit">Save</button>
                                </form>

                                <form action="{{ route('deleteCategory', $category->cid) }}" method="POST"
                                    class="d-inline m-0">
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
        // alert success for add category
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

        // alert success for update category
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
                    text: 'You want to delete this category?',
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
