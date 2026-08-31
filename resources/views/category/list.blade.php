@extends('layouts.app')

@section('title', 'List Category')

@section('content')

    <div class="container">

        <h3>List Category</h3>

        <div class="row">
            <div class="col-md-12">
                <br>

                <div id="message"></div>

                <form method="post" action="">
                    @csrf

                    <table class="table table-bordered">
                        <tr>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>

                        {{-- <tr>
                            <td colspan="3">No record found!</td>
                        </tr> --}}

                        <tr>
                            <td>
                                <input type="text" class="form-control" name="category_name" value=""
                                    placeholder="Category Name" required>
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
                </form>
            </div>
        </div>

    </div>

@endsection
