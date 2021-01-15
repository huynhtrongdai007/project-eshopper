  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png') }}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @php
          $img = auth()->user()->image;
         @endphp
          <img src="{{asset('public/uploads/users/'.$img.'')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->name}}</a>
        </div>
        <div class="info">
          <a href="{{ route('admin.logout') }}">LogOut</a>
        </div>      
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../index.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Category
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.category.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>create</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.category.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>list category</p>
                </a>
              </li>
            </ul>
          
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Brand
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.brand.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>create</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.brand.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>list brand</p>
                </a>
              </li>
            </ul>
          
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-users nav-icon"></i>
              <p>
                User
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.user.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>create</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.user.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>list User</p>
                </a>
              </li>
            </ul>
          
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-images"></i>
              <p>
                Slide
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.slide.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>create</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.slide.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>list Slide</p>
                </a>
              </li>
            </ul>
          
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Product
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.product.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>create</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.product.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>list Product</p>
                </a>
              </li>
            </ul>
          
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-cog nav-icon"></i>
              <p>
                Setting
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.setting.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>create</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.setting.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>list Settings</p>
                </a>
              </li>
            </ul>
          
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Role
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.role.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>create</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.role.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>list Role</p>
                </a>
              </li>
            </ul>
          
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
                Permission
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.permission.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>create</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.permission.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>list Permission</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-bars nav-icon"></i>
              <p>
                Menu
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.menu.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>create</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.menu.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>list Menu</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Customer
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.customer.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>list Customer</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-address-book nav-icon"></i>
              <p>
               
                Contact
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.contact.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>list Contact</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-shopping-cart"></i>
              <p>
                Order
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.order.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>list Orders</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-shopping-cart"></i>
              <p>
                Post
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.post.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>list Post</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.post.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Post</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
