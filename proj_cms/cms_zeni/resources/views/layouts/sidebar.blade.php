<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img class="logo-large" src="https://via.placeholder.com/300x70"
             alt="{{ __('resources.design.sitename') }}" style="width: 100%;">
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <i class="fas fa-user-circle fa-2x" style="color: #c2c7d0;"></i>
            </div>
            <div class="info">
                <a href="javascript:void(0);" class="d-block">Admin</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-compact" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Sale management -->
                <li class="nav-item has-treeview menu-open">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: block;">
                        <li class="nav-item">
                            <a href="{{ route('list.post') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản lý Posts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('list.page') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản lý Pages</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('list.category') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản lý Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('list.user') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản lý Users</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
</aside>
