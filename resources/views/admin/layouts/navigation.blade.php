<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link py-3">
        <img src="{{asset ('img/ArbaMinchUniversity-logo_0.gif')}}" class="img-fluid" style="width:70px;height:70px" alt="ArbaMinch University Logo">

      <span class="brand-text font-weight-light">AMU CSIMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2"
           alt="User Image"> --}}
        </div>
        <div class="info">
          <a href="#" class="d-block">Administrator</a>
        </div>
      </div>



      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item @if(Request::is('admin/dashboard')) bg-primary @endif">
            <a href="{{route('admin.dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard

              </p>
            </a>

          </li>

          <li class="nav-item ">
            <a href="#" class="nav-link @if(Request::is('admin/manage-account/*')) bg-primary @endif">
              <i class="nav-icon fas  fas fa-unlock-alt"></i>
              <p>
                Manage Account
                <i class="fas fa-angle-left right"></i>

              </p>
            </a>
            <ul class="nav  @if(!Request::is('admin/manage-account/*')) nav-treeview  @endif ml-3">
              <li class="nav-item @if(Request::is('admin/manage-account/create-account')) bg-secondary @endif">
                <a href="{{route('admin.create')}}" class="nav-link">
                  <i class="far fas fa-user-shield nav-icon"></i>
                  <p>create account</p>
                </a>
              </li>
              <li class="nav-item  @if(Request::is('admin/manage-account/list-of-user')) bg-secondary @endif">
                <a href="{{ route('admin.listofuser')}}" class="nav-link">
                  <i class="far fas fa-user-lock nav-icon"></i>
                  <p>list of user</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item ">
            <a href="#" class="nav-link ">
              <i class="nav-icon far fa-bell"></i>
              <p>
                Notification

              </p>
            </a>

          </li>
          <li class="nav-item  @if(Request::is('admin/change-password')) bg-primary @endif">
            <a href="{{route('admin.changepassword')}}" class="nav-link ">
              <i class="nav-icon far fa-comments"></i>
              <p>
                change password

              </p>
            </a>

          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
