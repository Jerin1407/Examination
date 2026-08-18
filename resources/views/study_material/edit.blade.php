@extends('layouts.app')

@section('title', 'Edit Study Material')

@section('content')

    <div class="container">

        <h3>Edit Study Material</h3>

        <div class="row">
            <form method="post" action="" enctype="multipart/form-data">
                @csrf

                <div class="col-md-8">
                    <br>
                    <div class="login-panel panel panel-default">
                        <div class="panel-body">

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" required id="title" name="title" value=""
                                    class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="study_description">Description</label>
                                <textarea id="study_description" name="study_description" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="userfile">File Upload</label>
                                <input type="file" required id="userfile" name="userfile">
                            </div>

                            <div class="form-group">
                                <label for="cid">Category</label>
                                <select name="cid" id="cid" class="form-control">
                                    <option value="0">--Select--</option>
                                    <option value="">Category 1</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Group Name</label> <br>

                                <input type="checkbox" name="gid[]" value=""> Group 1 &nbsp; &nbsp; &nbsp;
                            </div>

                            <button class="btn btn-default" type="submit">Submit</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

@endsection
