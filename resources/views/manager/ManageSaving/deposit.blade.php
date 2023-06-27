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

@if($errors->any())
<div class="bg-danger text-white p-2 m-3">
    @foreach ($errors->all() as $error)
    <p class="px-2 py-1 my-0 d-flex justify-content-center align-items-center">{{$error}}</p>
    @endforeach
</div>
@endif

@if(session()->has('message'))
<div class="bg-success text-white m-2">
    <p class="p-2 d-flex justify-content-center align-items-center">{{session('message')}}</p>
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
                                <a class="nav-link active" data-toggle="pill" href="#addsingleuser"><i class="fa fa-plus-circle mr-1"></i>For Single Member</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#uploadexcel">Upload Excel Sheet</a>
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
                                            <input type="text" name="zmember" id="zmember" class="form-control" list="mems">
                                            <datalist id="mems">
                                               //show all members
                                              @if($members->count()>0)
                                              @foreach($members as $member)
                                                <option value="{{$member->user_id}}">{{$member->firstname}} {{$member->middlename}} {{$member->lastname}}</option>
                                              @endforeach
                                              @endif
                                            </datalist>
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
                                                <input type="text" name="saving_amount" value="{{ old ('saving_amount')}}" required class="form-control" id="saving_percent" placeholder="saving amount">
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
                                <div class="col-md-6">

                                        <div class="card-body">
                                            <form action="{{route('manager.uploaddeposit')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="">
                                                    <div class="form-group">
                                                        <input type="file" name="upload_deposit" id="js-upload-files" multiple accept=".xlsx, .xls, .csv" required>
                                                    </div>

                                                    <div>
                                                        <button type="submit" class="btn btn-sm btn-primary" id="js-upload-submit">Upload files</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection
