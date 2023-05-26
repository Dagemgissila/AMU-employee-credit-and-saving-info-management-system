<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      {{-- <img src="" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      <span class="brand-text font-weight-light">AMU saving</span>
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
          <a href="#" class="d-block">admin</a>
        </div>
      </div>



      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item @if(Request::is('manager/dashboard'))  bg-primary @endif">
            <a href="{{route('manager.dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard

              </p>
            </a>

          </li>


          <li class="nav-item">
            <a href="#" class="nav-link @if(Request::is('manager/manage-member/*')) active @endif">
              <i class="nav-icon fas  fa-users"></i>
              <p>
                manage members
                <i class="fas fa-angle-left right"></i>

              </p>
            </a>
            <ul class="nav @if(!Request::is('manager/manage-member/*')) nav-treeview  @endif ml-3">
              <li class="nav-item  @if(Request::is('manager/manage-member/addmembers')) bg-secondary @endif">
                <a href="{{route('manager.addmembers')}}" class="nav-link">
                  <i class="far fa fa-plus-circle nav-icon"></i>
                  <p>add member</p>
                </a>
              </li>
              <li class="nav-item @if(Request::is('manager/manage-member/view-member-info')) bg-secondary @endif">
                <a href="" class="nav-link">
                  <i class="far fas fa-align-justify nav-icon"></i>
                  <p>view member info</p>
                </a>
              </li>
            </ul>
          </li>



 <li class="nav-item">
            <a href="" class="nav-link @if(Request::is('manager/saving-account/*')) active @endif">
              <i class="nav-icon far fa-money-bill-alt"></i>
              <p>
                Saving Account
                <i class="fas fa-angle-left right"></i>

              </p>
            </a>
            <ul class="nav nav-treeview ml-3">
              <li class="nav-item">
                <a href="members.html" class="nav-link">
                    <i class="far fas fa-align-justify nav-icon"></i>
                  <p>saving list</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                    <i class="far fa fa-plus-circle nav-icon"></i>
                  <p>make deposit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>make withdraw</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa-money-bill-alt"></i>
              <p>
                Manage share
                <i class="fas fa-angle-left right"></i>

              </p>
            </a>
            <ul class="nav nav-treeview ml-3">
              <li class="nav-item">
                <a href="/addmembers" class="nav-link">
                  <i class="far fa fa-plus-circle nav-icon"></i>
                  <p>sell share</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="listofmembers" class="nav-link">
                  <i class="far fas fa-align-justify nav-icon"></i>
                  <p>view sold share</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-hand-holding-usd"></i>
              <p>
                Manage Loans
                <i class="fas fa-angle-left right"></i>

              </p>
            </a>
            <ul class="nav nav-treeview ml-3">
              <li class="nav-item">
                <a href="members.html" class="nav-link">
                    <i class="far fa fa-plus-circle nav-icon"></i>
                  <p>add new credit</p>
                </a>
              </li>
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
            <a href="#" class="nav-link">
              <i class="nav-icon fas  fas fa-unlock-alt"></i>
              <p>
                Manage Account
                <i class="fas fa-angle-left right"></i>

              </p>
            </a>
            <ul class="nav nav-treeview ml-3">
              <li class="nav-item">
                <a href="members.html" class="nav-link">
                  <i class="far fas fa-user-shield nav-icon"></i>
                  <p>Members account</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fas fa-user-lock nav-icon"></i>
                  <p>Admin account</p>
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
