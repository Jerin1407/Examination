 <!-- Page Wrapper -->
 <div id="wrapper">
     <!-- Sidebar -->
     <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

         <!-- Sidebar - Brand -->
         <a class="sidebar-brand d-flex align-items-center justify-content-center">
             <span class="logos">
                 <img src="{{ asset('images/logo2.svg') }}" class="logo-style" />
             </span>
         </a>
         <center><span style="color:#ffffff;">{{ $hres[1]->setting_value ?? '' }}</span></center>

         <!-- Divider -->
         <hr class="sidebar-divider my-0">

         <!-- Nav Item - Dashboard -->
         <li class="nav-item active">
             <a class="nav-link" href="{{ route('dashboard') }}">
                 <i class="fas fa-fw fa-tachometer-alt"></i>
                 <span>Dashboard</span>
             </a>
         </li>

         <!-- Divider -->
         <hr class="sidebar-divider">

         <!-- Nav Item - Users Collapse Menu -->
         <li class="nav-item">
             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                 aria-expanded="true" aria-controls="collapseTwo">
                 <i class="fas fa-fw fa-users"></i>
                 <span>Users</span>
             </a>

             <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                 <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="{{ route('addUser') }}">Add New</a>

                     <a class="collapse-item" href="{{ route('listUser') }}">Users List</a>

                     <a class="collapse-item" href="{{ route('showAppointment') }}">My Appointments</a>
                 </div>
             </div>
         </li>

         <!-- Nav Item - Question Bank Collapse Menu -->
         <li class="nav-item">
             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                 aria-expanded="true" aria-controls="collapseUtilities">
                 <i class="fas fa-fw fa-university"></i>
                 <span>Question Bank</span>
             </a>
             <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                 <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="{{ route('addQuestion') }}">Add New</a>

                     <a class="collapse-item" href="{{ route('listQuestion') }}">Question List</a>
                 </div>
             </div>
         </li>

         <!-- Nav Item - Quiz Collapse Menu -->
         <li class="nav-item">
             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseQuiz"
                 aria-expanded="true" aria-controls="collapseQuiz">
                 <i class="fas fa-fw fa-chalkboard-teacher"></i>
                 <span>Exam</span>
             </a>
             <div id="collapseQuiz" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                 <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="{{ route('addExam') }}">Add New</a>

                     <a class="collapse-item" href="{{ route('listExam') }}">Exam List</a>
                 </div>
             </div>
         </li>

         <!-- Nav Item - Result Collapse Menu -->
         <li class="nav-item">
             <div id="collapseResult" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                 <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="">result</a>
                 </div>
             </div>
         </li>

         <!-- Nav Item - Valuation Collapse Menu -->
         <li class="nav-item">
             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMark"
                 aria-expanded="true" aria-controls="collapseMark">
                 <i class="fas fa-fw fa-folder"></i>
                 <span>Valuation</span>
             </a>
             <div id="collapseMark" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                 <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="{{ route('listMark') }}">Mark List</a>
                 </div>
             </div>
         </li>

         <!-- Nav Item - Study Material Collapse Menu -->
         <li class="nav-item">
             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStudy"
                 aria-expanded="true" aria-controls="collapseStudy">
                 <i class="fas fa-fw fa-book"></i>
                 <span>Study Material</span>
             </a>
             <div id="collapseStudy" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                 <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="{{ route('listStudyMaterial') }}">Study Material</a>
                 </div>
             </div>
         </li>

         <!-- Nav Item - Setting Collapse Menu -->
         <li class="nav-item">
             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSetting"
                 aria-expanded="true" aria-controls="collapseSetting">
                 <i class="fas fa-fw fa-cog"></i>
                 <span>Setting</span>
             </a>
             <div id="collapseSetting" class="collapse" aria-labelledby="headingPages"
                 data-parent="#accordionSidebar">
                 <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="{{ route('editSetting') }}">Setting</a>
                     <a class="collapse-item" href="{{ route('listNotification') }}">Notification</a>
                     <a class="collapse-item" href="{{ route('listUserGroup') }}">User Group</a>
                     <a class="collapse-item" href="{{ route('listCategory') }}">Category List</a>
                     <a class="collapse-item" href="{{ route('listLevel') }}">Level List</a>
                     <a class="collapse-item" href="{{ route('listAccountType') }}">Account Type</a>
                     <a class="collapse-item" href="{{ route('listCustomFields') }}">Custom Registration Fields</a>
                     <a class="collapse-item" href="">Payment History</a>
                     <a class="collapse-item" href="">Advertisment</a>
                 </div>
             </div>
         </li>

         <!-- Nav Item - Support Collapse Menu -->
         <li class="nav-item">
             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSupport"
                 aria-expanded="true" aria-controls="collapseStudy">
                 <i class="fas fa-fw fa-question-circle"></i>
                 <span>Support</span>
             </a>
             <div id="collapseSupport" class="collapse" aria-labelledby="headingPages"
                 data-parent="#accordionSidebar">
                 <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="">Setting</a>
                 </div>
             </div>
         </li>

     </ul>
     <!-- End of Sidebar -->

     <!-- Content Wrapper -->
     <div id="content-wrapper" class="d-flex flex-column">
         <!-- Main Content -->
         <div id="content">

             <!-- Topbar -->
             <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                 <!-- Sidebar Toggle (Topbar) -->
                 <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                     <i class="fa fa-bars"></i>
                 </button>

                 <!-- Topbar Navbar -->
                 <ul class="navbar-nav ml-auto">

                     <!-- Nav Item - Alerts -->
                     <li class="nav-item dropdown no-arrow mx-1">
                         <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <i class="fas fa-bell fa-fw"></i>
                             <!-- Counter - Alerts -->
                             <span class="badge badge-danger badge-counter"></span>
                         </a>
                         <!-- Dropdown - Alerts -->
                         <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="alertsDropdown">
                             <h6 class="dropdown-header">
                                 Notification
                             </h6>

                             <a class="dropdown-item d-flex align-items-center" href="">
                                 <div>
                                     <div class="small text-gray-500">13/08/2024
                                     </div>
                                     <span class="font-weight-bold">There are no
                                         pending appointments</span>
                                 </div>
                             </a>

                             <a class="dropdown-item d-flex align-items-center" href="">
                                 <div>
                                     <div class="small text-gray-500">
                                     </div>
                                     <span class="font-weight-bold"></span>
                                 </div>
                             </a>

                             <a class="dropdown-item d-flex align-items-center" href="#">
                                 <div class="small text-gray-500"><span class="font-weight-bold">No
                                         notification for you!</span></div>
                             </a>
                         </div>
                     </li>

                     <div class="topbar-divider d-none d-sm-block"></div>

                     <!-- Nav Item - User Information -->
                     <li class="nav-item dropdown no-arrow">
                         <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{ session('first_name') }} {{ session('last_name') }}
                             </span>
                         </a>
                         <!-- Dropdown - User Information -->
                         <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">

                             <a class="dropdown-item" href="{{ route('editUser', session('uid')) }}">
                                 <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400">My Account</i>
                             </a>

                             <div class="dropdown-divider"></div>
                             <form method="POST" action="{{ route('logout') }}" class="d-inline" id="logoutForm">
                                 @csrf

                                 <button type="button" class="dropdown-item" id="logoutBtn"
                                     style="border: none; background: none; width: 100%; text-align: left;">
                                     <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                     Logout
                                 </button>
                             </form>
                         </div>
                     </li>

                 </ul>
             </nav>
             <!-- End of Topbar -->

             <script>
                 // Logout Alert
                 document.getElementById('logoutBtn').addEventListener('click', function(e) {
                     const Toast = Swal.mixin({
                         toast: true,
                         position: 'top',
                         showConfirmButton: true,
                         showCancelButton: true,
                         confirmButtonText: 'Yes, logout',
                         cancelButtonText: 'Cancel',
                         timerProgressBar: true,
                         background: '#EF4444', // red
                         color: '#fff',
                         iconColor: '#fff'
                     });

                     Toast.fire({
                         icon: 'warning',
                         title: 'Are you sure you want to logout?'
                     }).then((result) => {
                         if (result.isConfirmed) {
                             document.getElementById('logoutForm').submit();
                         }
                     });
                 });
             </script>
