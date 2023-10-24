<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EAM | Employee Attendance Manager</title>
    <link rel="stylesheet" href="{{ asset('backend') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/css/style.css">
</head>
<body>

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
           <!-- OffCanvas Trigger -->
           <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
            <span class="navbar-toggler-icon" data-bs-target="#offcanvasExample"></span>
           </button>
           <!-- OffCanvas Trigger -->

           <a class="navbar-brand fw-bold text-uppercase me-auto" href="#">EAM</a>
           <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
           </button>
           <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex ms-auto" role="search">
                <div class="input-group my-3 my-lg-0">
                  <input type="text" class="form-control" placeholder="Search..." aria-label="Recipient's username" aria-describedby="button-addon2">
                  <button class="btn btn-primary" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
                </div>
            </form>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  
                        @if (Auth::check())
                            {{ Auth::user()->name }}
                        @elseif (Auth::guard('employee')->check()) 
                            {{ Auth::guard('employee')->user()->full_name }}
                        @endif
                
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ url('logout') }}">Logout</a></li>
                    </ul>
                </li>
            </ul>
          </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Offcanvas Start -->
    <div class="offcanvas offcanvas-start sidebar-nav bg-dark text-white" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
          <span class="me-2">
            <i class="bi bi-speedometer2"></i>
          </span>
          <h5 class="offcanvas-title me-auto" id="offcanvasExampleLabel">Dashboard</h5>
          <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0">
            <nav class="navbar-dark">
                <ul class="navbar-nav">
                     
                    @if (Auth::check())
                    <li>
                        <a href="#" class="nav-link px-3">
                            <span class="me-2">
                                <i class="bi bi-person"></i>
                            </span>
                            <span>Employee List</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('logout') }}" class="nav-link px-3">
                            <span class="me-2">
                                <i class="bi bi-person"></i>
                            </span>
                            <span>Logout</span>
                        </a>
                    </li>
                    @elseif (Auth::guard('employee')->check()) 

                    <li>
                        <a href="{{ url('profile') }}" class="nav-link px-3">
                            <span class="me-2">
                                <i class="bi bi-person"></i>
                            </span>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('logout') }}" class="nav-link px-3">
                            <span class="me-2">
                                <i class="bi bi-person"></i>
                            </span>
                            <span>Logout</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
    <!-- Offcanvas End -->

    <!-- Main Content Start -->
    @yield('content')
    <!-- Main Content End -->
    

    <script src="{{ asset('backend') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('backend') }}/js/jquery-3.5.1.js"></script>
    <script src="{{ asset('backend') }}/js/script.js"></script>
</body>
</html>