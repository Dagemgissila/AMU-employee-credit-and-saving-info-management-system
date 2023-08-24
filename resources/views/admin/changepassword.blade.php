@extends('admin.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Change password</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">

        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
 </div>

   <!-- Main content -->
   <section class="content">
    <div class="container-fluid">
        <div class="card card-default">

            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">

                    <!-- general form elements -->
                    <div class="card card-secondary">

                      <!-- /.card-header -->
                      <!-- form start -->
                      <form action="{{route('admin.changepassword')}}" method="POST">
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

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </form>
                    </div>

                  </div>
              <!-- /.row -->
            </div>
            <!-- /.card-body -->

          </div>



        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
</section>
@endsection
