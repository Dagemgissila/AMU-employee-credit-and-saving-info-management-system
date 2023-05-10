@extends('admin.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Add members</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>

          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
 </div>



  <!-- Tab panes -->


   <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

              <div class="card">
                <div class="card-header">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                          <a class="nav-link active" data-toggle="pill" href="#addsingleuser"><i class="fa fa-plus-circle mr-1"></i>ADD single member</a>
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
                                            <label for="firstname">Fisrt Name</label>
                                            <input type="text" class="form-control" id="firstname" placeholder="first name">
                                          </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="middlename">Middle Name</label>
                                            <input type="text" class="form-control" id="middlename" placeholder="middle name">
                                          </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lastname">Last Name</label>
                                            <input type="text" class="form-control" id="lastname" placeholder="last name">
                                          </div>
                                    </div>
                                 </div>

                                 <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="username">User Name</label>
                                            <input type="number" class="form-control" id="username" placeholder=" e.g 1364">
                                          </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="accountnumber">Bank Account Number</label>
                                            <input type="number" class="form-control" id="accountnumber" placeholder=" e.g 1000356...">
                                          </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="phonenumber">Phone Number</label>
                                            <input type="number" class="form-control" id="lastname" placeholder=" e.g 09547***">
                                          </div>
                                    </div>
                                 </div>
                                 <hr>
                                 <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="salary">Salary</label>
                                            <input type="number" class="form-control" id="salary" placeholder=" e.g 15000.00">
                                          </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="campus">campus</label>
                                            <select class="form-control " style="width: 100%;">
                                                <option selected="selected">main</option>
                                                <option>kulfo</option>
                                                <option>nechsar</option>
                                                <option>abaya</option>
                                                <option>chamo</option>
                                                <option>sawula</option>

                                              </select>
                                          </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="colleage">colleage</label>
                                            <select class="form-control " style="width: 100%;">
                                                <option selected="selected">AMIT</option>
                                                <option>AWIT</option>
                                                <option>MEDICAL</option>


                                              </select>
                                          </div>
                                    </div>

                                 </div>

                                 <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sex">sex</label>
                                            <select class="form-control " style="width: 100%;">
                                                <option selected="selected">Female</option>
                                                <option>Male</option>


                                              </select>
                                          </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="marriage">Married</label>
                                            <select class="form-control " style="width: 100%;">
                                                <option selected="selected">married</option>
                                                <option>Single</option>


                                              </select>
                                          </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="date">Registered Date</label>
                                            <input type="date" class="form-control" id="date">
                                        </div>
                                    </div>
                                 </div>
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
