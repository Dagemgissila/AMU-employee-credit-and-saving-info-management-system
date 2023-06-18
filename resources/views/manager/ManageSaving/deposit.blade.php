@extends('manager.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Make Deposit</h1>
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
                          <a class="nav-link active" data-toggle="pill" href="#addsingleuser"><i class="fa fa-plus-circle mr-1"></i>for single member</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="pill" href="#uploadexcel">UPLOAD excel sheet</a>
                        </li>

                      </ul>
                 </div>

                <div class="card-body">

                    <div class="tab-content" >
                        <div class="tab-pane container-fluid active" id="addsingleuser">

                            <form action="{{route('manager.makedeposit')}}" method="POST">
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
                                 <div class="row">
                                   <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="firstname">Member Name</label>
                                            <select name="zmember" id="zmember" class="form-control">
                                              <option value="">--select--</option>
                                               //show all members
                                              @if($members->count()>0)
                                              @foreach($members as $member)
                                                <option value="{{$member->user_id}}">{{$member->firstname}} {{$member->middlename}} {{$member->lastname}}</option>
                                              @endforeach
                                              @endif
                                            </select>
                                          </div>
                                    </div>
                                     <!--
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="firstname">User name</label>
                                            <input type="text" name="username" value="{{ old('username') }}" required class="form-control" id="username" placeholder="username">
                                          </div>
                                          @if ($errors->has('username'))
                                              <div class="text-danger">{{ $errors->first('username') }}</div>
                                           @endif
                                    </div>
                                   
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="middlename">Saving Amount</label>
                                            <input type="text" name="saving_amount"  value="{{ old ('saving_amount')}}" required class="form-control" id="saving_percent" placeholder="saving amount">
                                          </div>
                                          @if ($errors->has('saving_amount'))
                                          <div class="text-danger">{{ $errors->first('saving_amount') }}</div>
                                       @endif
                                    </div>
                                      -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lastname">Saving Month</label>
                                            <input type="date" name="saving_month" value="{{ old ('saving_month') }}" required class="form-control" id="lastname" placeholder="last name">
                                          </div>
                                          @if ($errors->has('saving_month'))
                                          <div class="text-danger">{{ $errors->first('saving_month') }}</div>
                                       @endif
                                    </div>
                                 </div>

                                 <div class="col-md-2">
                                    <div class="input-group my-1">
                                        <button class="btn btn-primary w-100 fs-6">Submit Deposit</button>
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
