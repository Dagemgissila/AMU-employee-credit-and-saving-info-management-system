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

                            <form action="">


                                 <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="username">User Name</label>
                                            <input type="number" class="form-control" id="username" placeholder=" enter user name">
                                          </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="accountnumber">email address</label>
                                            <input type="email" class="form-control" id="accountnumber" placeholder=" enter user email address">
                                          </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="campus">Role</label>
                                            <select class="form-control" style="width: 100%;" id="role-select" required>
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
