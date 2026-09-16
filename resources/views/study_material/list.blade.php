@extends('layouts.app')

@section('title', 'List Study Material')

@section('content')

    <div class="container">

        <h3>List Study Material</h3>

        <div class="row">
            <div class="col-lg-6">
                <form method="get" action="{{ route('listStudyMaterial') }}">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search..."
                            value="{{ $search ?? '' }}">
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

                <a href="{{ route('addStudyMaterial') }}" class="btn btn-success">Add New</a><br><br>

                <table class="table table-bordered">
                    <tr>
                        <th>SI.No</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>

                    @forelse ($studyMaterials as $index => $material)
                        <tr>
                            <td>{{ $studyMaterials->firstItem() + $index }}</td>
                            <td>{{ $material->title }}</td>
                            <td>{{ \Illuminate\Support\Str::words(strip_tags($material->study_description), 6, '...') }}
                            </td>
                            <td>{{ $material->category_name ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('editStudyMaterial', $material->stid) }}">Edit</a>

                                <a href="{{ route('viewStudyMaterial', $material->stid) }}">View</a>

                                <a href=""
                                    onclick="return confirm('Are you sure you want to remove this study material?');">Remove</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No records found</td>
                        </tr>
                    @endforelse
                </table>

                {{ $studyMaterials->links() }}
            </div>
        </div>

        <a href="" class="btn btn-primary">Back</a>
        &nbsp;&nbsp;
        <a href="" class="btn btn-primary">Next</a>

    </div>

    <script>

        // alert success for add study material
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

        // alert success for update study material
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
