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

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<style>
    .login-pic {
        width: 465px;
        height: 439px;
    }
</style>

<body class="">

    <div class="container">

        <div class="row" style="border-bottom:1px solid #dddddd;">
            <div class="container">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <a href="">
                        {{-- <img src="{{ asset('images/logo.png') }}"> --}}
                    </a>
                    Online exam Management System
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>

        <div class="container">

            <div style="margin-top:50px;margin-bottom:50px;">
                <h3>Select Package/Group</h3>
            </div>

            <div class="card" style="margin-bottom:50px;">
                <div class="card-header">
                    <h4>Cart</h4>
                </div>
                <div class="panel-body">
                    <p style="margin:10px; padding:10px; border-bottom:1px solid #dddddd;" class="hoverbg">
                        SBR (Price: 0)
                        <a href=""><i class="fa fa-trash" style="float:right;color:#666666;"></i></a>
                    </p>
                </div>
                <div class="card-footer">
                    <a href="" class="btn btn-warning">
                        Checkout total 0
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            group_name
                        </div>
                        <div class="card-body" style="height:250px;overflow-y:auto;">
                            description
                        </div>
                        <div class="card-footer">
                            Free
                            SBR (Price: 0)

                            <a href="" class="btn btn-success">addtocart</a>
                        </div>
                    </div>
                </div>
            </div>

            <div style="margin-top:50px;">
                <a href="">Back</a>
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

    <script>
        // alert message for error
        @if (session('error_login'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#EF4444', // red color
                color: '#fff',
                iconColor: '#fff',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            Toast.fire({
                icon: 'error',
                title: '{{ session('error_login') }}'
            });
        @endif

        // alert message for login first
        @if (session('login_first'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#EF4444', // red color
                color: '#fff',
                iconColor: '#fff',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            Toast.fire({
                icon: 'error',
                title: '{{ session('login_first') }}'
            });
        @endif

        // alert success for logout
        @if (session('success_logout'))
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
                title: '{{ session('success_logout') }}'
            });
        @endif
    </script>

</body>

</html>
