@extends('auth.layout')

@section('content')


<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center ">

        <div class="col-xl-6 col-lg-7 col-md-8">

            <div class="card o-hidden border-0 shadow-lg my-4 px-3">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row ">

                        <div class="col-lg-12">
                            <div class="p-2">
                                <div class="header-text d-flex  justify-content-around align-items-center mt-2" style="width:100%;">
                                    <img src="{{asset ('img/ArbaMinchUniversity-logo_0.gif')}}" class="img-fluid d-none d-md-flex" style="width:16vw;height:17vh;">
                                    <h2 class="text-primary" style="margin-left:1.3em">A.M.U Workers Saving & Credit Association</h2>
                                </div>
                                  <hr style="border:1px solid rgb(38, 38, 38);width:100%">

                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-1">Admin Registration Page</h1>
                                </div>
                                <div class="text-center ">
                                    <p class="text-danger m-0 font-weight-bold ">this page can not display again once you create account,
                                        please fill the following form carefully</p>
                                 </div>

                               <div>
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
                                    <input type="password" name="password"  class="form-control form-control" placeholder="Enter Password">
                                  </div>
                                  <div>
                                    <p class="font-italic">the password must be at least 8 character, it must contain at least 1 uppercase,1 lowercase ,1 number and 1 speacial character</p>
                                  </div>
                                  @if ($errors->has('password'))
                                  <div class="text-danger">{{ $errors->first('password') }}</div>
                              @endif
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">confirm Password</label>
                                    <input type="password" name="confirm_password"  class="form-control form-control" placeholder="confirm password">
                                  </div>
                                  @if ($errors->has('confirm_password'))
                                  <div class="text-danger">{{ $errors->first('confirm_password') }}</div>
                              @endif
                                  <div class="input-group mb-2">
                                    <button class="btn btn-lg btn-primary w-100 fs-6">Create Account</button>
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
