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
            <img src="{{asset('img/ArbaMinchUniversity-logo_0.gif')}}" class="img-fluid" style="width:90px;height:90px;">
            <p class="text-wrap text-left" style="width: 22rem;font-weight:bold;margin:0;">AMU employee credit and saving information management system</p>
          </div>

          <hr style="border:1px solid rgb(38, 38, 38);width:100%">

         <div class="w-100 my-1">
            <h2 class="text-primary float-left">ADMIN REGISTRATION PAGE</h2>
         </div>
         <div class="w-100">
            <p class="text-danger float-left font-weight-bold">this page can not display again once you create account,
                please fill the follwing carefully</p>
         </div>


         <div class="w-100">
            <form action="{{ route('admin.register')}}" method="POST">
                @csrf
                @if(session()->has('error'))
                <div class="bg-danger text-white">
                  <p class="p-2 d-flex justify-content-center align-items-center">   {{session('error')}}</p>
                </div>
                @endif
                <div class="form-group">
                    <label for="exampleInputEmail1">username</label>
                    <input type="text" name="username" value="{{ old('username') }}" class="form-control form-control"  placeholder="Enter username">
                  </div>

                  @if ($errors->has('username'))
                  <div class="text-danger">{{ $errors->first('username') }}</div>
              @endif
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control"  placeholder="Enter email">
              </div>
              @if ($errors->has('email'))
              <div class="text-danger">{{ $errors->first('email') }}</div>
          @endif
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" value="{{ old('password') }}" class="form-control form-control" placeholder="Enter Password">
              </div>
              @if ($errors->has('password'))
              <div class="text-danger">{{ $errors->first('password') }}</div>
          @endif
              <div class="form-group">
                <label for="exampleInputPassword1">confirm Password</label>
                <input type="password" name="confirm_password" value="{{ old('confirm_password') }}" class="form-control form-control" placeholder="confirm password">
              </div>
              @if ($errors->has('confirm_password'))
              <div class="text-danger">{{ $errors->first('confirm_password') }}</div>
          @endif
              <div class="input-group mb-5">
                <button class="btn btn-lg btn-primary w-100 fs-6">Create Account</button>
              </div>

            </form>
          </div>



       </div>

       <div class=" col-md-6 right rounded-4 d-flex justify-content-center align-items-center flex-column ">

           <div class="featured-image mb-3 d-none d-md-block">
            <img src="{{ asset ('img/Sign up.gif')}}" class="img-fluid" style="width:100%;height:100%;">

           </div>

       </div>
      </div>
    </div>


@endsection
