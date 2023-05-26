@extends('admin.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Create Account</h1>
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

        <div class="row">
            <div class="col-md-12">

              <div class="card">
                <div class="card-header">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                          <a class="nav-link active" data-toggle="pill" href="#addsingleuser"><i class="fa fa-plus-circle mr-1"></i>Create Single User</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="pill" href="#uploadexcel">UPLOAD excel sheet</a>
                        </li>

                      </ul>
                 </div>

                <div class="card-body">

                    <div class="tab-content" >
                        <div class="tab-pane container-fluid active" id="addsingleuser">

                            <form action="{{ route('admin.create')}}" method="POST" >
                             @csrf
                             @if(session()->has('error'))
                             <div class="bg-danger text-white">
                               <p class="p-2 d-flex justify-content-center align-items-center">   {{session('error')}}</p>
                             </div>
                             @endif
                             @if(session()->has('message'))
                             <div class="bg-success text-white">
                               <p class="p-2 d-flex justify-content-center font-weight-bold align-items-center lead">   {{session('message')}}</p>
                             </div>
                             @endif
                                 <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="username">User Name</label>
                                            <input type="text" class="form-control" value="{{ old('username') }}" name="username" id="username" placeholder=" enter user name" >
                                          </div>
                                          @if ($errors->has('username'))
                                          <div class="text-danger">{{ $errors->first('username') }}</div>
                                      @endif
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="accountnumber">email address</label>
                                            <input type="email" class="form-control" value="{{old('email')}}" name="email" id="accountnumber" placeholder=" enter user email address">
                                          </div>
                                          @if ($errors->has('email'))
                                          <div class="text-danger">{{ $errors->first('email') }}</div>
                                      @endif
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="campus">Role</label>
                                            <select name="role" value="{{old('role')}}" class="form-control" style="width: 100%;" id="role-select" required>
                                                <option value="">-- Please select a role --</option>
                                                <option value="admin">Admin</option>
                                                <option value="manager">Manager</option>
                                                <option value="member">Member</option>
                                            </select>

                                        </div>
                                    </div>
                                 </div>



                                 <button class="btn btn-primary">create account</button>
                            </form>

                        </div>

                        <div class="my-3">
                            <p class="font-italic font-weight-bold">The system automatically creates a password for the user, which is initially set as 12345678. However, for security purposes, the system mandates users to change this password after logging in for the first time</p>
                        </div>
                        <div class="tab-pane container-fluid fade" id="uploadexcel">
                            <div class="container-fluid">
                                <div class="panel panel-default">
                                  <div class="panel-heading"><strong>Upload excel file</strong></div>
                                  <div class="panel-body">

                                    <!-- Standar Form -->
                                    <h5>Select file from your computer</h5>
                                    <form action="" method="post" enctype="multipart/form-data" id="js-upload-form">
                                      <div class="form-inline">
                                        <div class="form-group">
                                          <input type="file" name="files[]" id="js-upload-files" multiple>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-primary" id="js-upload-submit">Upload files</button>
                                      </div>
                                    </form>

                                  </div>
                                </div>
                              </div> <!-- /container -->
                        </div>

                      </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->


              <!-- /.card -->

            </div>

            <!-- /.col (right) -->
          </div>
</div><!-- /.container-fluid -->
</section>
@endsection
