

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
                                    <h2 class="text-primary d-flex justify-content-start">Reset Password</h2>
                                </div>



                                <div class="w-100">
                                    <form action="{{route('new-password')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="token" value="{{$token}}">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" name="email" class="form-control form-control"  placeholder="Enter new password">
                                          </div>
                                          @if ($errors->has('email'))
                                          <div class="text-danger">{{ $errors->first('email') }}</div>
                                      @endif
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">new password</label>
                                        <input type="password" name="password" class="form-control form-control"  placeholder="Enter new password">
                                      </div>
                                      @if ($errors->has('password'))
                                      <div class="text-danger">{{ $errors->first('password') }}</div>
                                  @endif

                                      <div class="form-group">
                                        <label for="exampleInputEmail1">confirm password</label>
                                        <input type="password" name="confirm_password" class="form-control form-control"   placeholder="Confirm password">
                                      </div>
                                      @if ($errors->has('confirm_password'))
                                      <div class="text-danger">{{ $errors->first('confirm_password') }}</div>
                                  @endif

                                      <div class="input-group mb-5">
                                        <button class="btn btn-lg btn-primary w-100 fs-6">continue</button>
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

