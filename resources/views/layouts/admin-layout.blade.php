<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title")</title>

    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
    <script src="{{asset('js/preloader.js')}}"></script>

</head>

<body class="hold-transition sidebar-mini"  onload="loader()">

<div class="position-absolute justify-content-center  top-50 start-50 translate-middle">
    <img src="/loader.png" id="loader" alt="loader" >
</div>

<div class="wrapper" id="body" style="display: none">
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <div class="info">
            <a href="/administrator" class="brand-link">
                <i class="bi bi-house"></i>
                <span class="brand-text font-weight-light">Админ-панель</span>
            </a>
            <a href="/" class="brand-link ">
                <i class="bi bi-bag text-white-50"></i>
                <span class="brand-text font-weight-light">Обратно на главную</span>
            </a>
        </div>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block">
                        <i class="bi bi-person text-white-50"></i>
{{--                        {{Auth::user()->name}}--}}
                    </a>

                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                           aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item menu-open bg-gradient-dark">
                        <a href="#" class="nav-link ">
                            <i class="bi bi-speedometer2"></i>
                            <p>
                                Заказы
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/administrator/order/" class="nav-link">
                                    <p>Все заказы</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/administrator/order/create" class="nav-link">
                                    <i class="bi bi-plus-square"></i>
                                    <p>Добавить заказ</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item menu-open bg-gradient-dark">
                        <a href="#" class="nav-link">
                            <i class="bi bi-people"></i>
                            <p>
                                Пользователи
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item ">
                                <a href="/administrator/users/" class="nav-link">
                                    <p>Все пользователи</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/administrator/user/create" class="nav-link">
                                    <i class="bi bi-plus-square"></i>
                                    <p>Добавить пользователя</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item menu-open bg-gradient-dark">
                        <a href="#" class="nav-link ">
                            <i class="bi bi-calculator"></i>
                            <p>
                                Расчет цен
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/administrator/product" class="nav-link">
                                    <i class="bi bi-box-seam"></i>
                                    <p>Товары</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/administrator/product/create" class="nav-link">
                                    <i class="bi bi-plus-square"></i>
                                    <p>Добавить товар</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/administrator/material" class="nav-link">
                                    <i class="bi bi-flower3"></i>
                                    <p>Материалы</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/administrator/material/create" class="nav-link">
                                    <i class="bi bi-plus-square"></i>
                                    <p>Добавить материал</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item menu-open bg-gradient-dark">
                        <a href="#" class="nav-link">
                            <p>
                                <i class="bi bi-bookmark"></i>Категории
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item ">
                                <a href="/administrator/category/" class="nav-link">
                                    <p>Категории</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/administrator/category/create" class="nav-link">
                                    <i class="bi bi-plus-square"></i>
                                    <p>Добавить категорию</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="/administrator/contact" class="nav-link">
                            <i class="bi bi-chat"></i>
                            <p>Сообщения пользователей</p>
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Fiori_VRN</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div id="app" class="row">
                    <app></app>
                    {{--@yield('content')--}}
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

<!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">

    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{mix('js/app.js')}}"></script>
<script src="{{asset('admin/dist/js/adminlte.js')}}"></script>

<!-- OPTIONAL SCRIPTS -->
{{--<script src="admin/plugins/chart.js/Chart.min.js"></script>--}}
{{--<!-- AdminLTE for demo purposes -->--}}
{{--<script src="admin/dist/js/demo.js"></script>--}}
{{--<!-- AdminLTE dashboard demo (This is only for demo purposes) -->--}}
{{--<script src="admin/dist/js/pages/dashboard3.js"></script>--}}
</body>
</html>
