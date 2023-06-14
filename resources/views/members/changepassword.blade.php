@extends('members.layouts.app')
@section('content')
<div class="wrapper">
<section class="content mt-2">
    <div class="container card">
        <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                  @if(auth()->user()->password_status == 0)
                  <div class="continer">
                      <h2> Dear Members</h2>
                      <p class="m-0">Welcome to Amu employee credit and saving management system.
                          your security is our top priority ,so we kindly ask you you to change your default password upon your first login</p>
                          <p class="m-1">to ensure the safety of your account we require your new password that meet the following criteria</p>
                          <ul class="list-group px-4 py-1 font-italic font-weight-bold">
                              <li>the  password you choose must be at least 8 characters long</li>
                              <li>it must contain at least 1 upper case</li>
                              <li>it must contain at least 1 lower case</li>
                              <li>it must contain number at least 1 number</li>
                              <li>it must contain number at least 1 special character</li>

                          </ul>
                  </div>

               @endif


                  <!-- general form elements -->
                  <div class="@if(auth()->user()->password_status == 0) contaier @endif">

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('member.changepassword')}}" method="POST">
                      @csrf
                      @if(session()->has('message'))
                      <div class="bg-success text-white">
                        <p class="p-2 d-flex justify-content-center align-items-center">   {{session('message')}}</p>
                      </div>
                      @endif
                      @if(session()->has('error'))
                      <div class="bg-danger text-white">
                        <p class="p-2 d-flex justify-content-center align-items-center">   {{session('error')}}</p>
                      </div>
                      @endif

                      <div class="card-body">
                        <div class="form-group">
                          <label for="">Old password</label>
                          <input type="password" name="oldpassword" required class="form-control" id="" placeholder="Enter old password">
                        </div>
                        @if ($errors->has('oldpassword'))
                        <div class="text-danger">{{ $errors->first('oldpassword') }}</div>
                    @endif

                        <div class="form-group">
                          <label for="">New password</label>
                          <input type="password" name="newpassword" required class="form-control" id="exampleInputPassword1" placeholder="enter new password">
                        </div>

                        @if($errors->has('newpassword'))
                        <div class="text-danger">{{$errors->first('newpassword')}}</div>
                        @endif
                        <div class="form-group">
                          <label for="">New password</label>
                          <input type="password" name="confirm_password" required class="form-control" id="exampleInputPassword1" placeholder="confirm password">
                        </div>

                        @if($errors->has('confirm_password'))
                        <div class="text-danger">{{$errors->first('confirm_password')}}</div>
                        @endif

                        <div class="form-group">
                            <button class="btn btn-primary">Change Password</button>

                          </div>

                      </div>
                      <!-- /.card-body -->


                    </form>
                  </div>

                </div>
            <!-- /.row -->
          </div>



        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
</section>
</div>
@endsection
