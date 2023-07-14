<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('creditmanager.dashboard')}}" class="brand-link py-3">
        <img src="{{asset ('img/ArbaMinchUniversity-logo_0.gif')}}" class="img-fluid" style="width:60px;height:60px" alt="ArbaMinch University Logo">

      <span class="brand-text font-weight-light">AMU CSIMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-1 pb-3 mb-1 d-flex justify-content-center align-items-center">

        <div class="info">

          <a href="" class="d-block">Credit Manager</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item @if(Request::is('credit-manager/dashboard'))  bg-primary @endif">
            <a href="{{route('creditmanager.dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{route('creditmanager.viewmember')}}" class="nav-link @if(Request::is('credit-manager/view-member-info')) active @endif">
              <i class="nav-icon fas  fa-users"></i>
              <p>
                View Member Info
              </p>
            </a>
          </li>


        <li class="nav-item">
            <a href="" class="nav-link @if(Request::is('manager/manage-credit/*')) active @endif">
                <i class="nav-icon far fa-money-bill-alt"></i>
              <p>
                Manage Loans
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav @if(!Request::is('manager/manage-credit/*')) nav-treeview  @endif ml-3">



              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                   <i class="far fas fa-align-justify nav-icon"></i>
                  <p>view credit list</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                   <i class="far fas fa-align-justify nav-icon"></i>
                  <p>view witness list</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                   <i class="far fas fa-align-justify nav-icon"></i>
                  <p>view credit request</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                    <i class="far fa fa-plus-circle nav-icon"></i>
                  <p>add credit repayment</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{route('creditmanager.viewshare')}}" class="nav-link  @if(Request::is('credit-manager/view-member-share')) active @endif">
                <i class="nav-icon far fa-money-bill-alt"></i>
              <p>
                <p>view sold share</p>

              </p>
            </a>

          </li>


          <li class="nav-item ">
            <a href="{{route('creditmanager.changepassword')}}" class="nav-link @if(Request::is('user/changepassword')) bg-primary @endif">
                <i class="nav-icon fas  fas fa-unlock-alt"></i>
              <p>
                 change password
              </p>
            </a>

          </li>

          <li class="nav-item ">
            <a href="#" class="nav-link ">
              <i class="nav-icon far fa-comments"></i>
              <p>
                Feed Back
              </p>
            </a>

          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
