 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="" class="navbar-brand">
          <img src="{{asset ('img/ArbaMinchUniversity-logo_0.gif')}}" class="brand-image img-circle elevation-3" style="opacity: .8;width:40px;heighr:40px;" alt="ArbaMinch University Logo">
          <span class="px-2 m-0">AMU CSIMS</span>
      </a>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="{{route('member.dashboard')}}" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="{{route('member.savingaccount')}}" class="nav-link">Saving Account</a>
          </li>

          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Credit</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="{{route('member.mycredit')}}" class="dropdown-item">View My Credit </a></li>
              <li><a href="{{route('member.ViewRequestPage')}}" class="dropdown-item">Request Credit</a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{route('member.share')}}" class="nav-link">Share</a>
          </li>

          <li class="nav-item">
            <a href="{{ route('member.notification') }}" class="nav-link">
                Notification
                @if($notificationCount > 0)

                    <span class="badge bg-danger">{{$notificationCount}}</span>
                @endif
                <div class="toast-container">
  <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="..." class="rounded me-2" alt="...">
      <strong class="me-auto">Bootstrap</strong>
      <small class="text-muted">just now</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      See? Just like this.
    </div>
  </div>

  <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="..." class="rounded me-2" alt="...">
      <strong class="me-auto">Bootstrap</strong>
      <small class="text-muted">2 seconds ago</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Heads up, toasts will stack automatically
    </div>
  </div>
</div>
            </a>
        </li>

          {{-- <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Feedback</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="#" class="dropdown-item">Send Feedback </a></li>
              <li><a href="" class="dropdown-item">View Replay</a></li>

            </ul>
          </li> --}}
        </ul>


      </div>
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
         <li class="nav-item">
        <a href="{{route('member.dashboard')}}" class="nav-link">{{Auth::user()->username}}</a>
      </li>

      <li class="nav-item d-flex align-items-center">

      </li>


        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Setting</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="{{route('member.profile')}}" class="dropdown-item">Profile </a></li>
              <li><a href="{{route('member.changepassword')}}" class="dropdown-item">Change Password</a></li>

              <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </li>



              <!-- Level two dropdown-->

              <!-- End Level two -->
            </ul>
          </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->
