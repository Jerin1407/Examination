@extends('layouts.app')

@section('title', 'Add New User')

@section('content')
    <div class="container">

        <h3>Add New User</h3>

        <div class="row">
            <form method="post" action="">
                @csrf

                <div class="col-md-8">
                    <br>
                    <div class="login-panel panel panel-default">
                        <div class="panel-body">

                            <div class="form-group">
                                <label for="inputEmail" class="sr-only">Email Address</label>
                                <input type="email" id="inputEmail" name="email" class="form-control"
                                    placeholder="Email Address" value="" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword" class="sr-only">Password</label>
                                <input type="password" id="inputPassword" name="password" class="form-control"
                                    placeholder="Password" required>
                            </div>

                            <div class="form-group">
                                <label for="first_name" class="sr-only">First Name</label>
                                <input type="text" id="first_name" name="first_name" class="form-control"
                                    placeholder="First Name" value="" autofocus>
                            </div>

                            <div class="form-group">
                                <label for="last_name" class="sr-only">Last Name</label>
                                <input type="text" id="last_name" name="last_name" class="form-control"
                                    placeholder="Last Name" value="" autofocus>
                            </div>

                            <div class="form-group">
                                <label for="contact_no" class="sr-only">Contact Number</label>
                                <input type="text" id="contact_no" name="contact_no" class="form-control"
                                    placeholder="Contact Number" value="" autofocus>
                            </div>

                            <div class="form-group">
                                <label for="gid">Select Group</label>
                                <select class="form-control" name="gid" id="gid" onchange="getexpiry();">
                                    <option value="0">Select Group</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="subscription_expired">Subscription Expired</label>
                                <input type="text" name="subscription_expired" id="subscription_expired"
                                    class="form-control" placeholder="Subscription Expired" value="" autofocus>
                            </div>

                            <div class="form-group">
                                <label for="su">Account Type</label>
                                <select class="form-control" name="su" id="su">
                                    <option value="0">Select Account Type</option>
                                </select>
                            </div>

                            <button class="btn btn-default" type="submit">Submit</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <script>
        getexpiry();
    </script>
@endsection
