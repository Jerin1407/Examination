<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PlusGoals</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<style>
    .login-pic {
        width: 465px;
        height: 439px;
    }
</style>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">

                            <img src="{{ asset('images/login_pic.jpg') }}" class="login-pic" />
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        {{-- $appSetting is passed from the controller instead of querying the DB in the view --}}
                                        <h1 class="h4 text-gray-900 mb-4">
                                            <span class="logos">
                                                <img src="{{ asset('images/logo2.svg') }}" />
                                            </span>
                                        </h1>
                                    </div>

                                    <form class="user" method="POST" action="">
                                        @csrf

                                        {{-- @if (session('message'))
                                            <div class="alert alert-danger">
                                                {!! str_replace('{resend_url}', route('login.resend'), session('message')) !!}
                                            </div>
                                        @endif

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul class="mb-0">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif --}}

                                        <div class="form-group">
                                            <input type="email" name="email" value=""
                                                class="form-control form-control-user" id="exampleInputEmail"
                                                aria-describedby="emailHelp" placeholder="Email Address">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password"
                                                class="form-control form-control-user" id="exampleInputPassword"
                                                placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>

                                    </form>

                                    <div class="text-center">
                                        <a class="small" href="">Forgot password?</a>
                                        <a class="small ml-2" href="">Open Exams</a>
                                    </div>

                                    <hr>

                                    <div class="text-center">
                                        <a class="btn btn-danger btn-user btn-block" href="">Register a new
                                            account</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html>
