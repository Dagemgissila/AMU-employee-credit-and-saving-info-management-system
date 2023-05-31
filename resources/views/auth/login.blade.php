@extends('auth.layout')

@section('content')

  <!----------------------- Main Container -------------------------->
  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <!----------------------- Login Container -------------------------->

       <div class="row rounded bg-white w-100" >
    <!--------------------------- Left Box ----------------------------->

    <!-------------------- ------ Right Box ---------------------------->

       <div class="col-md-6 left d-flex align-items-center  flex-column p-3 p-sm-4 my-5">

        <div class="header-text d-flex  justify-content-around align-items-center mt-3" style="width:100%;">
            <img src="{{asset ('img/ArbaMinchUniversity-logo_0.gif')}}" class="img-fluid" style="width:90px;height:90px;">
            <p class="text-wrap text-left" style="width: 22rem;font-weight:bold;margin:0;">AMU employee credit and saving information management system</p>
          </div>

          <hr style="border:1px solid rgb(38, 38, 38);width:100%">

         <div class="w-100 my-3">
            <h2 class="text-primary float-left">Sign In</h2>
         </div>


         <div class="w-100">
            <form action="{{ route('login.userlogin')}}" method="POST">
                @csrf
                @if(session()->has('message'))
                <div class="bg-danger text-white">
                  <p class="p-2 d-flex justify-content-center align-items-center">   {{session('message')}}</p>
                </div>
                @endif

                @if(session()->has('success'))
                <div class="bg-success text-white">
                  <p class="p-2 d-flex justify-content-center align-items-center">   {{session('success')}}</p>
                </div>
                @endif
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control form-control-lg"  placeholder="Enter email">
              </div>
              @if ($errors->has('email'))
              <div class="text-danger">{{ $errors->first('email') }}</div>
          @endif
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Enter Password">
              </div>
              @if ($errors->has('password'))
              <div class="text-danger">{{ $errors->first('password') }}</div>
          @endif
              <div class="input-group mb-5 d-flex justify-content-between">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="formCheck">
                  <label for="formCheck" class="form-check-label text-secondary"><small>Remember Me</small></label>
                </div>
                <div class="forgot">
                  <small><a href="/forget-password">Forgot Password?</a></small>
                </div>
              </div>
              <div class="input-group mb-5">
                <button class="btn btn-lg btn-primary w-100 fs-6">Login</button>
              </div>

            </form>
          </div>



       </div>

       <div class=" col-md-6 right rounded-4 d-flex justify-content-center align-items-center flex-column ">

           <div class="featured-image mb-3 d-none d-md-block">
            <img src="img/My password.gif" class="img-fluid" style="width:100%;height:100%;">

           </div>

       </div>
      </div>
    </div>


@endsection
