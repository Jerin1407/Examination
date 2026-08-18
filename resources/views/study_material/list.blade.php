@extends('layouts.app')

@section('title', 'List Study Material')

@section('content')

    <div class="container">

        <h3>List Study Material</h3>

        <div class="row">
            <div class="col-lg-6">
                <form method="post" action="">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search...">
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

                    {{-- <tr>
                        <td colspan="6">No records found</td>
                    </tr> --}}

                    <tr>
                        <td>1</td>
                        <td>Study Material 1</td>
                        <td>Study Material 1 Description</td>
                        <td>Category 1</td>
                        <td>
                            <a href="{{ route('editStudyMaterial') }}">Edit</a>

                            <a href="{{ route('viewStudyMaterial') }}">View</a>

                            <a href="">Remove</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <a href="" class="btn btn-primary">Back</a>
        &nbsp;&nbsp;
        <a href="" class="btn btn-primary">Next</a>

    </div>

@endsection
