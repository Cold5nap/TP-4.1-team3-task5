<template>
  <div class="wrapper">
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-light position-fixed elevation-4">
      <!-- Brand Logo -->
      <div class="info">
        <router-link :to="{ name: 'home' }" class="brand-link">
          <i class="bi bi-house"></i>
          <span class="brand-text font-weight-light">Администрация</span>
        </router-link>

        <a href="/" class="brand-link">
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
              <!--                                {{Auth::user()->name}}-->
            </a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search" />
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
            <li class="nav-item rounded">
              <router-link :to="{ name: 'orders' }" class="nav-link">
                <i class="bi bi-speedometer2"></i>
                <p>Заказы</p>
              </router-link>
            </li>
            <li class="nav-item rounded">
              <router-link :to="{ name: 'users' }" class="nav-link">
                <i class="bi bi-people"></i>
                <p>Пользователи</p>
              </router-link>
            </li>
            <li class="nav-item rounded">
              <router-link :to="{ name: 'products' }" class="nav-link">
                <i class="bi bi-box-seam"></i>
                <p>Товары</p>
              </router-link>
            </li>
            <li class="nav-item rounded">
              <router-link :to="{ name: 'materials' }" class="nav-link">
                <i class="bi bi-flower3"></i>
                <p>Материалы</p>
              </router-link>
            </li>
            <li class="nav-item rounded">
              <router-link :to="{ name: 'categories' }" class="nav-link">
                <i class="bi bi-bookmark"></i>
                <p>Категории</p>
              </router-link>
            </li>
            <li class="nav-item rounded">
              <router-link :to="{ name: 'messages' }" class="nav-link">
                <i class="bi bi-chat"></i>
                <p>Сообщения пользователей</p>
              </router-link>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <div class="content bg-light">
        <div class="container-fluid">
          <div class="row">
            <router-view></router-view>
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
  </div>
</template>

<script>
export default {
  data() {
    return {
      pageName: "Главная",
    };
  },
};
</script>

