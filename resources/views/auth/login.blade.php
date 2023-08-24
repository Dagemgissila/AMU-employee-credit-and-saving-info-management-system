@extends('auth.layout')

@section('content')


<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center align-items-center mt-5">

        <div class="col-xl-6 col-lg-7 col-md-8 ">

            <div class="card o-hidden border-0 shadow-lg my-4 px-3 ">
                <div class="card-body p-0 ">
                    <!-- Nested Row within Card Body -->
                    <div class="row ">

                        <div class="col-lg-12 py-4">
                            <div class="p-3">
                                <div class="header-text d-flex  justify-content-around align-items-center mt-2" style="width:100%;">
                                    <img src="{{asset ('img/ArbaMinchUniversity-logo_0.gif')}}" class="img-fluid d-none d-md-flex" style="width:16vw;height:17vh;">
                                    <h2 class="text-primary" style="margin-left:1.3em">A.M.U Workers Saving & Credit Association</h2>
                                </div>
                                  <hr style="border:1px solid rgb(38, 38, 38);width:100%">

                                  <div class="text-center">
                                    <h2 class="text-primary d-flex justify-content-start">Sign In</h2>
                                </div>



                               <div>

                                <form action="{{ route('login.userlogin')}}" method="POST" class="w-100">
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
                                    <label for="exampleInputEmail1">Username</label>
                                    <input type="text" name="username" class="form-control form-control-lg"  placeholder="Username">
                                  </div>
                                  @if ($errors->has('username'))
                                  <div class="text-danger">{{ $errors->first('username') }}</div>
                              @endif
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Password">
                                  </div>
                                  @if ($errors->has('password'))
                                  <div class="text-danger">{{ $errors->first('password') }}</div>
                              @endif
                                  <div class="input-group mb-3 d-flex justify-content-between">
                                    <div class="form-check">
                                      <input type="checkbox" class="form-check-input" id="formCheck">
                                      <label for="formCheck" class="form-check-label text-secondary"><small>Remember Me</small></label>
                                    </div>
                                    <div class="forgot">
                                      <small><a href="/forget-password">Forgot Password?</a></small>
                                    </div>
                                  </div>
                                  <div class="input-group mb-1.7">
                                    <button class="btn btn-lg btn-primary w-50 fs-6">Sign In</button>
                                  </div>

                                </form>
                               </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>


@endsection
