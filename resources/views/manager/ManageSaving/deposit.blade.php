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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-light text-white">
                        <h2 class="card-title">
                          <i class="fas fa-user mr-2"></i> For Single User
                        </h2>
                      </div>
                    <div class="card-body">
                        <form action="{{route('manager.makedeposit')}}" method="POST">
                            @csrf


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="firstname">User name</label>
                                        <input type="text" name="username" value="{{ old('username') }}" required class="form-control" id="username" placeholder="username">
                                    </div>
                                    @if ($errors->has('username'))
                                        <div class="text-danger">{{ $errors->first('username') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="middlename">Saving Amount</label>
                                        <input type="text" name="saving_amount"  value="{{ old ('saving_amount')}}" required class="form-control" id="saving_percent" placeholder="saving percent">
                                    </div>
                                    @if ($errors->has('saving_amount'))
                                        <div class="text-danger">{{ $errors->first('saving_amount') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-12">
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
                                    <button class="btn btn-primary w-100 fs-6">Deposit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-light text-white">
                        <h2 class="card-title">
                          <i class="fas fa-file-excel mr-2"></i> Upload Excel Sheet
                        </h2>
                      </div>
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

</div><!-- /.container-fluid -->
</section>
@endsection
