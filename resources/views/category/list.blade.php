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

                                <a href="{{ route('deleteCategory') }}"
                                    onclick="return confirm('Are you sure you want to remove this category?');">
                                    <img src="{{ asset('images/cross.png') }}">
                                </a>
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
    </script>

@endsection
