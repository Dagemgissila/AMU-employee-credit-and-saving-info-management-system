@extends('manager.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Add Credit Payment</h1>
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

                            <form action="{{route('manager.creditPayment')}}" method="POST">
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
                                {{-- @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                 --}}


                                 <div class="row">
                                   <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="firstname">Select Credit Id/ Borrower Name</label>
                                            <input type="text" name="credit_id" value="{{old('credit_id')}}"  class="form-control" list="credit">
                                            <datalist id="credit">
                                               //show all members
                                              @if($members->count()>0)

                                              @foreach($members as $member)

                                                <option value="{{$member->id}}">{{$member->member->firstname}} {{$member->member->middlename}} {{$member->member->lastname}}</option>
                                              @endforeach
                                              @endif
                                            </datalist>
                                          </div>
                                          @if ($errors->has('credit_id'))
                                          <div class="text-danger">{{ $errors->first('credit_id') }}</div>
                                          @endif
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lastname">Paid Amount</label>
                                            <input type="text" name="paid_amount"  value="{{ old ('paid_amount') }}" required class="form-control"  placeholder="Enter Amount">
                                        </div>
                                        @if ($errors->has('paid_amount'))
                                        <div class="text-danger">{{ $errors->first('paid_amount') }}</div>
                                        @endif
                                    </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="lastname">Paid Month</label>
                                                <input type="date" name="paid_month" value="{{ old ('paid_month') }}" required class="form-control" id="lastname" placeholder="last name">
                                            </div>
                                            @if ($errors->has('paid_month'))
                                            <div class="text-danger">{{ $errors->first('paid_month') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="input-group my-1">
                                            <button class="btn btn-primary w-100 fs-6">Submit Payment</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane container-fluid fade" id="uploadexcel">
                                <div class="col-md-6">

                                        <div class="card-body">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="">
                                                    <div class="form-group">
                                                        <input type="file" name="upload_deposit"  multiple accept=".xlsx, .xls, .csv" required>
                                                    </div>

                                                    <div>
                                                        <button type="submit" class="btn btn-sm btn-primary" id="js-upload-submit">Upload files</button>
                                                    </div>
                                                </div>
                                            </form>
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
