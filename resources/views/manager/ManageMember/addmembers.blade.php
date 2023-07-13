@extends('manager.layouts.app')

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

  @if(session()->has('error'))
  <div class="bg-danger text-white">
    <p class="p-2 d-flex justify-content-center align-items-center">   {{session('error')}}</p>
  </div>
  @endif

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

                            <form action="{{route('manager.addmembers')}}" method="POST">
                                @csrf
                                @if(session()->has('message'))
                                <div class="bg-success text-white">
                                  <p class="p-2 d-flex justify-content-center align-items-center">   {{session('message')}}</p>
                                </div>
                                @endif
                                @if($errors->any())


                                  <div class="bg-danger text-white">
                                    @foreach ($errors->all() as $error)
                                    <p class="px-2 py-1 my-0 d-flex justify-content-center align-items-center">   {{$error}}</p>
                                    @endforeach
                                  </div>



                                @endif
                                @if(session()->has('error'))

                                @endif
                                 <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="firstname">Fisrt Name</label>
                                            <input type="text" name="firstname" value="{{ old('firstname') }}" required class="form-control" id="firstname" placeholder="first name">
                                          </div>
                                          @if ($errors->has('firstname'))
                                              <div class="text-danger">{{ $errors->first('firstname') }}</div>
                                           @endif
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="middlename">Middle Name</label>
                                            <input type="text" name="middlename" value="{{ old ('middlename')}}" required class="form-control" id="middlename" placeholder="middle name">
                                          </div>
                                          @if ($errors->has('middlename'))
                                          <div class="text-danger">{{ $errors->first('middlename') }}</div>
                                       @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lastname">Last Name</label>
                                            <input type="text" name="lastname" value="{{ old ('lastname') }}" required class="form-control" id="lastname" placeholder="last name">
                                          </div>
                                          @if ($errors->has('lastname'))
                                          <div class="text-danger">{{ $errors->first('lastname') }}</div>
                                       @endif
                                    </div>
                                 </div>

                                 <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="accountnumber">Bank Account Number</label>
                                            <input type="number" name="bankaccount" value="{{ old ('bankaccount')}}" required class="form-control" id="accountnumber" placeholder=" e.g 1000356...">
                                          </div>
                                          @if ($errors->has('bankaccount'))
                                          <div class="text-danger">{{ $errors->first('bankaccount') }}</div>
                                       @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="phonenumber">Phone Number</label>
                                            <input type="number" name="phonenumber" value="{{ old ('phonenumber')}}" required class="form-control" id="lastname" placeholder=" e.g 09547***">
                                          </div>
                                          @if ($errors->has('phonenumber'))
                                          <div class="text-danger">{{ $errors->first('phonenumber') }}</div>
                                       @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="campus">Campus</label>
                                            <select class="form-control " required name="campus" required style="width: 100%;">
                                                <option value="">-- Please select a campus --</option>
                                                <option value="Main">Main</option>
                                                <option value="Kulfo">Kulfo</option>
                                                <option value="Nechsar">Nechsar</option>
                                                <option value="Abaya">Abaya</option>
                                                <option value="Chamo">Chamo</option>
                                                <option value="Sawula">Sawula</option>
                                              </select>
                                          </div>
                                          @if ($errors->has('campus'))
                                          <div class="text-danger">{{ $errors->first('campus') }}</div>
                                       @endif
                                    </div>
                                 </div>
                                 <hr>


                                 <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sex">sex</label>
                                            <select class="form-control" required name="sex" style="width: 100%;">
                                                <option value="">-- Please select a sex --</option>
                                                <option value="Female">Female</option>
                                                <option value="Male">Male</option>


                                              </select>
                                              @if ($errors->has('sex'))
                                              <div class="text-danger">{{ $errors->first('sex') }}</div>
                                           @endif
                                          </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="marriage">martial status</label>
                                            <select class="form-control" required  name="martial_status" style="width: 100%;">
                                                <option value="">-- Please select a martial status --</option>
                                                <option value="Married">Married</option>
                                                <option value="Single">Single</option>
                                              </select>
                                              @if ($errors->has('martial_status'))
                                              <div class="text-danger">{{ $errors->first('martial_status') }}</div>
                                           @endif
                                          </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="colleage">colleage</label>
                                            <select class="form-control " name="colleage" style="width: 100%;">
                                                <option value="">-- Please select a colleage --</option>
                                                <option value="Amit">Amit</option>
                                                <option value="Awit">Awit</option>
                                                <option value="Medical">Medical</option>
                                              </select>
                                          </div>
                                          @if ($errors->has('colleage'))
                                          <div class="text-danger">{{ $errors->first('colleage') }}</div>
                                       @endif
                                    </div>

                                 </div>

                                 <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="salary">Salary</label>
                                            <input type="number"name="salary" required  value="{{ old ('salary')}}"  class="form-control" id="salary" placeholder=" e.g 15000.00">
                                          </div>
                                          @if ($errors->has('salary'))
                                          <div class="text-danger">{{ $errors->first('salary') }}</div>
                                       @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="salary">Saving Percent</label>
                                            <input type="number"name="savingpercent" required  value="{{ old ('salary')}}"  class="form-control" id="salary" placeholder=" e.g 10">
                                          </div>
                                          @if ($errors->has('SavingPercent'))
                                          <div class="text-danger">{{ $errors->first('SavingPercent') }}</div>
                                       @endif
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="date">Registered Date</label>
                                            <input type="date" name="registered_date" value="{{old('date')}}" required class="form-control" id="date">
                                            @if ($errors->has('registered_date'))
                                            <div class="text-danger">{{ $errors->first('registered_date') }}</div>
                                         @endif
                                        </div>
                                    </div>

                                  <div class="col-md-2">
                                    <div class="input-group my-3">
                                        <button class="btn  btn-primary w-100 fs-6">Add member</button>
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
                                    <form action="{{route('manager.uploadmember')}}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                      <div class="form-inline">
                                        <div class="form-group">
                                            <label for="member_excel_data">Member Data Excel File:</label>
                                            <input type="file" name="member_excel_data"  class="form-control-file" accept=".xlsx,.xls,.csv" required>
                                            @error('member_excel_data')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-primary" id="js-upload-submit">Upload files</button>
                                      </div>
                                    </form>





                                  </div>
                                </div>
                                <hr>
                              </div> <!-- /container -->
                             <div class="container-fluid p-4">
                                <h3>The GuideLine To Upload Excel File to Add Members</h3>
                                <ul>
                                    <li> the excel file must be in .xlsx,.xls,.csv  format</li>
                                    <li>the firts row the Excel File Contain header column</li>
                                    <li>
                                        The columns in the Excel file should be organized as follows:</li>
                                        <ol>
                                            <li>FirstName</li>
<li>MiddleName</li>
<li>LastName</li>
<li>PhoneNumber</li>
<li>BankAccount</li>
<li>Salary</li>
<li>SavingPercent</li>
<li>Campus</li>
<li>College <i>(optional)</i> </li>
<li>Sex</li>
<li>MartialStatus</li>
<li>RegisteredDate</li>

                                        </ol>
                                        <li>RegisteredDate column format is mm/dd/yyyy  . month/date/year</li>
                                        <h1>Here Sample File</h1>
                                        <a href="{{route('download.samplefile')}}" type="button" class="btn btn-primary my-3">Download Sample File</a>
                             <img src="{{asset('img/excelsample.PNG')}}" class='img-fluid' alt="">
                                </ul>
                             </div>
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
