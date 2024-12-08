<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CRUD ALL BY DENI')</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background: linear-gradient(90deg, #4caf50, #2196f3);
            color: white;
        }
        .navbar .nav-link {
            color: white;
        }
        .navbar .nav-link:hover {
            text-decoration: underline;
        }
        .main-sidebar {
            background-color: #343a40;
        }
        .main-sidebar .nav-link {
            color: #c2c7d0;
        }
        .main-sidebar .nav-link.active {
            background-color: #007bff;
            color: white;
        }
        .main-sidebar .nav-link:hover {
            background-color: #495057;
            color: white;
        }
        .brand-text {
            font-size: 1.5rem;
            color: #fff;
            font-weight: bold;
            text-align: center;
            display: block;
            padding: 20px 0;
        }
        .content-header {
            background-color: #f8f9fa;
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
        }
        footer {
            background-color: #343a40;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-user-circle"></i> Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-sign-out-alt"></i> Keluar</a>
                </li>
            </ul>
        </nav>

        <!-- Sidebar -->
        <aside class="main-sidebar elevation-4">
            <div class="brand-text">APP CRUD</div>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Parent Menu -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Master
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <!-- Submenu -->
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('categories.index') }}" class="nav-link">
                                        <i class="fas fa-tags nav-icon"></i>
                                        <p>Kategori</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('products.index') }}" class="nav-link">
                                        <i class="fas fa-product-hunt nav-icon"></i>
                                        <p>Produk</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('companies.index') }}" class="nav-link">
                                        <i class="fas fa-building nav-icon"></i>
                                        <p>Company</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('customers.index') }}" class="nav-link">
                                        <i class="fas fa-users nav-icon"></i>
                                        <p>Customer</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title', '')</h1>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2024 <a href="#">By Deni</a>.</strong> All rights reserved.
            <div class="float-right d-none d-sm-inline">
                <b>Version</b> 3.2.0
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script>
        $(function () {
            $('[data-widget="pushmenu"]').PushMenu();
        });
    </script>
</body>
</html>
