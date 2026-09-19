@extends('layouts.app')

@section('title', 'Add Account Type')

@section('content')

    <div class="container">

        <h3>Add Account Type</h3>

        <div class="row">
            <form method="post" action="{{ route('saveAccountType') }}">
                @csrf

                <div class="col-md-8">
                    <br>
                    <div class="login-panel panel panel-default">
                        <div class="panel-body">

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" value="" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Users</label><br>

                                <label class="checkbox-inline">
                                    <input type="checkbox" value="Add" name="users[]">Add
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="Edit" name="users[]">Edit
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="View" name="users[]">view
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="List" name="users[]">List
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="List_all" name="users[]">List All
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="Myaccount" name="users[]">My Account
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="Remove" name="users[]">Remove
                                </label>

                            </div>
                            <div class="form-group">
                                <label>Quiz</label><br>

                                <label class="checkbox-inline">
                                    <input type="checkbox" value="Attempt" name="quiz[]">Attempt
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="Add" name="quiz[]">Add
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="Edit" name="quiz[]">Edit
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="View" name="quiz[]">view
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="List" name="quiz[]">List
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="List_all" name="quiz[]">List All
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="Remove" name="quiz[]">Remove
                                </label>

                            </div>
                            <div class="form-group">
                                <label>Result</label><br>

                                <label class="checkbox-inline">
                                    <input type="checkbox" value="View" name="results[]">view
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="List" name="results[]">List
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="List_all" name="results[]">List All
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="Remove" name="results[]">Remove
                                </label>

                            </div>
                            <div class="form-group">
                                <label>Questions</label><br>

                                <label class="checkbox-inline">
                                    <input type="checkbox" value="Add" name="questions[]">Add
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="Edit" name="questions[]">Edit
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="View" name="questions[]">view
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="list" name="questions[]">List
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="List_all" name="questions[]">List
                                    All
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="Remove" name="questions[]">Remove
                                </label>

                            </div>
                            <div class="form-group">
                                <label>Study Material</label><br>

                                <label class="checkbox-inline">
                                    <input type="checkbox" value="Add" name="study_material[]">Add
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="Edit" name="study_material[]">Edit
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="View" name="study_material[]">view
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="List" name="study_material[]">List
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="List_all" name="study_material[]">List All
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="Remove" name="study_material[]">Remove
                                </label>

                            </div>
                            <div class="form-group">
                                <label>Appointment</label><br>

                                <label class="checkbox-inline">
                                    <input type="checkbox" value="Add" name="appointment[]">Add
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="Edit" name="appointment[]">Edit
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="View" name="appointment[]">view
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="List" name="appointment[]">List
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="List_all" name="appointment[]">List All
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="Remove" name="appointment[]">Remove
                                </label>

                            </div>
                            <div class="form-group">
                                <label>Setting</label><br>

                                <label class="checkbox-inline">
                                    <input type="checkbox" value="All" name="setting">All
                                </label>

                            </div>

                            <button class="btn btn-info" type="submit">Submit</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

@endsection
