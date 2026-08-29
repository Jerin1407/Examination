@extends('layouts.app')

@section('title', 'Edit User Group')

@section('content')

    <div class="container">

        <h3>Edit User Group</h3>

        <div class="row">
            <form method="post" action="">
                @csrf

                <div class="col-md-8">
                    <br>
                    <div class="login-panel panel panel-default">
                        <div class="panel-body">

                            <div class="form-group">
                                <label for="group_name">Group Name</label>
                                <input type="text" required id="group_name" name="group_name" class="form-control"
                                    value="">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="price">Price (numeric only)</label>
                                <input type="text" required id="price" name="price" class="form-control"
                                    value="{{ old('price', 0) }}"> <br>
                            </div>

                            <div class="form-group">
                                <label for="valid_for_days">Valid for days, 0 = unlimited</label>
                                <input type="text" required id="valid_for_days" name="valid_for_days"
                                    class="form-control" value="{{ old('valid_for_days', 0) }}">
                            </div>

                            <button class="btn btn-default" type="submit">Submit</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

@endsection
