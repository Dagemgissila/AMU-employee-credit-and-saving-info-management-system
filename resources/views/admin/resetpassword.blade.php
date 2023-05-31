@extends('admin.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Reset password</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>

          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
 </div>

   <!-- Main content -->
   <section class="content">
    <div class="container-fluid">

       <div class="card">
<div class="card-header">
    <h1>reset password</h1>
</div>

<div class="card-body">
    <div class="row ">
        <div class="col-6">
            <h3 class="font-weight-bold">Username : {{$user->username}}</h3>
            <p class="font-weight-bold font-style-italic lead text-info p=3">Please note that the password you choose must be at least 8 characters long and can be any  password.
          However, please keep in mind that the user must change their password immediately  by login in  to the systen.
</p>
        </div>

        <div class="col-6">
            <form action="{{route('admin.resetpassword',$user->id)}}" method="post">
                @if(session()->has('error'))
                <div class="bg-danger text-white">
                  <p class="p-2 d-flex justify-content-center align-items-center">   {{session('error')}}</p>
                </div>
                @endif
                @csrf
                  <div class="form-group">
                    <label for="password">New password</label>
                    <input type="password" class="form-control" name="password" id="" placeholder="enter new password">
                  </div>
                  @if ($errors->has('password'))
                  <div class="text-danger">{{ $errors->first('password') }}</div>
              @endif
                  <div class="form-group">
                    <label for="">Confirm password</label>
                    <input type="password" class="form-control" name="confirm_password" id="" placeholder="enter new password">
                  </div>
                  @if ($errors->has('confirm_password'))
                  <div class="text-danger">{{ $errors->first('confirm_password') }}</div>
              @endif

                <!-- /.card-body -->


                  <button type="submit" class="btn btn-primary">Reset password</button>

              </form>
        </div>
    </div>
</div>
       </div>
</div><!-- /.container-fluid -->
</section>
@endsection