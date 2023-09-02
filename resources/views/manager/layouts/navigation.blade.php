<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('manager.dashboard')}}" class="brand-link py-3">
        <img src="{{asset ('img/ArbaMinchUniversity-logo_0.gif')}}" class="img-fluid" style="width:60px;height:60px" alt="ArbaMinch University Logo">

      <span class="brand-text font-weight-light">AMU WSCA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-1 pb-3 mb-1 d-flex justify-content-center align-items-center">

        <div class="info">

          <a href="" class="d-block">Manager</a>
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
                Manage Members
                <i class="fas fa-angle-left right"></i>

              </p>
            </a>
            <ul class="nav @if(!Request::is('manager/manage-member/*')) nav-treeview  @endif ml-3">
              <li class="nav-item  @if(Request::is('manager/manage-member/addmember')) bg-secondary @endif">
                <a href="{{route('manager.addmembers')}}" class="nav-link">
                  <i class="far fa fa-plus-circle nav-icon"></i>
                  <p>Add Member</p>
                </a>
              </li>
              <li class="nav-item @if(Request::is('manager/manage-member/view-member-info')) bg-secondary @endif">
                <a href="{{route('manager.viewmember')}}" class="nav-link">
                  <i class="far fas fa-align-justify nav-icon"></i>
                  <p>View Member </p>
                </a>
              </li>
            </ul>
          </li>



        <li class="nav-item">
            <a href="" class="nav-link @if(Request::is('manager/manage-saving/*')) active @endif">
              <i class="nav-icon far fa-money-bill-alt"></i>
              <p>
                Saving Account
                <i class="fas fa-angle-left right"></i>

              </p>
            </a>
            <ul class="nav @if(!Request::is('manager/manage-saving/*')) nav-treeview  @endif ml-3">

              <li class="nav-item @if(Request::is('manager/manage-saving/saving-list')) bg-secondary @endif">
                <a href="{{route('manager.savinglist')}}" class="nav-link">
                    <i class="far fas fa-align-justify nav-icon"></i>
                  <p>Saving List</p>
                </a>
              </li>
              <li class="nav-item @if(Request::is('manager/manage-saving/make-deposit')) bg-secondary @endif">
                <a href="{{route('manager.makedeposit')}}" class="nav-link">
                    <i class="far fa fa-plus-circle nav-icon"></i>
                  <p>Make Deposit</p>
                </a>
              </li>

            </ul>
          </li>



@if(auth()->user()->role==='manager')
        <li class="nav-item">
            <a href="" class="nav-link @if(Request::is('manager/manage-credit/*')) active @endif">
                <i class="nav-icon far fa-money-bill-alt"></i>
              <p>
                Manage Credit
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav @if(!Request::is('manager/manage-credit/*')) nav-treeview  @endif ml-3">

              <li class="nav-item @if(Request::is('manager/manage-credit/addcredit')) bg-secondary @endif">
                <a href="{{route('manager.creditform')}}" class="nav-link">
                    <i class="far fa fa-plus-circle nav-icon"></i>
                  <p>Add New Credit</p>
                </a>
              </li>

              <li class="nav-item @if(Request::is('manager/manage-credit/creditlist')) bg-secondary @endif">
                <a href="{{route('manager.creditlist')}}" class="nav-link">
                    <i class="far fas fa-align-justify nav-icon"></i>
                  <p>View Credit List</p>
                </a>
              </li>

              <li class="nav-item @if(Request::is('manager/manage-credit/missed-credit-payment')) bg-secondary @endif">

                <a href="{{ route('manager.missedPayment') }}" class="nav-link">

                    <i class="far fas fa-align-justify nav-icon"></i>
                    <p>Payment Alert

                    </p>
                    @if(isset($missedPaymentCount) && $missedPaymentCount > 0)
                    <span class="badge badge-danger">{{ $missedPaymentCount }}</span>
                @endif
                </a>
            </li>


              <li class="nav-item @if(Request::is('manager/manage-credit/witness-list')) bg-secondary @endif">
                <a href="{{route('manager.witnesslist')}}" class="nav-link">
                   <i class="far fas fa-align-justify nav-icon"></i>
                  <p>View Witness List</p>
                </a>
              </li>
              <li class="nav-item  @if(Request::is('manager/manage-credit/view-request-credit')) bg-secondary @endif">
                <a href="{{ route('manager.ViewRequestCredit') }}" class="nav-link">
                    <i class="far fas fa-align-justify nav-icon"></i>
                    <p class="position-relative">
                        Requested Credit
                        @php
                            $count = $RequestCredits->where('status', 0)->count();
                        @endphp
                        @if ($count > 0)
                        <span class="badge bg-danger">{{$count}}</span>
                        @endif
                    </p>
                </a>
            </li>
              <li class="nav-item @if(Request::is('manager/manage-credit/credit-payment')) bg-secondary @endif">
                <a href="{{route('manager.creditPayment')}}" class="nav-link">
                    <i class="far fa fa-plus-circle nav-icon"></i>
                  <p>Add Credit Payment</p>
                </a>
              </li>



            </ul>
          </li>

@endif


          <li class="nav-item">
            <a href="#" class="nav-link  @if(Request::is('manager/manage-share/*')) active @endif">
                <i class="nav-icon far fa-money-bill-alt"></i>
              <p>
                Manage share
                <i class="fas fa-angle-left right"></i>

              </p>
            </a>
            <ul class="nav @if(!Request::is('manager/manage-share/*')) nav-treeview  @endif ml-3 ml-3">
              <li class="nav-item">
                <a href="{{route('manager.sellshare')}}" class="nav-link @if(Request::is('manager/manage-share/sell-share')) bg-secondary @endif">
                  <i class="far fa fa-plus-circle nav-icon"></i>
                  <p>Sell Share</p>
                </a>
              </li>
              <li class="nav-item @if(Request::is('manager/manage-share/view-share')) bg-secondary @endif">
                <a href="{{route('manager.viewshare')}}" class="nav-link">
                  <i class="far fas fa-align-justify nav-icon"></i>
                  <p>View Sold Share</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item ">
            <a href="#" class="nav-link @if(Request::is('manager/manage-account/*')) bg-primary @endif">
              <i class="nav-icon fas  fas fa-unlock-alt"></i>
              <p>
                Manage Account
                <i class="fas fa-angle-left right"></i>

              </p>
            </a>
            <ul class="nav  @if(!Request::is('manager/manage-account/*')) nav-treeview  @endif ml-3">
              <li class="nav-item @if(Request::is('manager/manage-account/create-account')) bg-secondary @endif">
                <a href="{{route('manager.createaccount')}}" class="nav-link">
                  <i class="far fas fa-user-shield nav-icon"></i>
                  <p>Create Account</p>
                </a>
              </li>
              <li class="nav-item  @if(Request::is('manager/manage-account/user-account')) bg-secondary @endif">
                <a href="{{route('manager.viewaccount')}}" class="nav-link">
                  <i class="far fas fa-user-lock nav-icon"></i>
                  <p>List Of Account</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item ">
            <a href="{{route('manager.changepassword')}}" class="nav-link @if(Request::is('manager/changepassword')) bg-primary @endif">
                <i class="nav-icon fas  fas fa-unlock-alt"></i>
              <p>
                 Change Password

              </p>
            </a>

          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
