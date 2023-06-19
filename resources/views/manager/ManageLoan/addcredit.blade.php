@extends('manager.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Add credit</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>

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
            <div class="col-md-8">

              <div class="card">
                <div class="card-header bg-info">
                    <h2 class="card-title">Add Credit </h2>
                  </div>

                <div class="card-body">

                    <div class="tab-content" >
                        <div class="tab-pane container-fluid active" id="addsingleuser">

                            <form action="{{route('manager.addcredit')}}" method="POST">
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstname">User name</label>
                                            <input type="text" name="username" value="{{ old('username') }}" required class="form-control" id="username" placeholder="username">
                                          </div>
                                          @if ($errors->has('username'))
                                              <div class="text-danger">{{ $errors->first('username') }}</div>
                                           @endif
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="middlename">Credit Amount</label>
                                            <input type="number" name="credit_amount"  value="{{ old ('credit_amount')}}" required class="form-control" id="saving_percent" placeholder="credit amount">
                                          </div>
                                          @if ($errors->has('credit_amount'))
                                          <div class="text-danger">{{ $errors->first('credit_amount') }}</div>
                                       @endif
                                    </div>

                                 </div>

                                 <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lastname">Credit Duartion in Month</label>
                                            <input type="number" name="credit_duration" value="{{ old ('credit_duration') }}" required class="form-control" id="lastname" placeholder="credit duration month">
                                          </div>
                                          @if ($errors->has('lastname'))
                                          <div class="text-danger">{{ $errors->first('credit_duration') }}</div>
                                       @endif
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstname">Interest Rate</label>
                                            <input type="" name="interest_rate" value="{{ old('interest_rate') }}" required class="form-control"  placeholder="interest rate in percent">
                                          </div>
                                          @if ($errors->has('interest_rate'))
                                              <div class="text-danger">{{ $errors->first('interest_rate') }}</div>
                                           @endif
                                    </div>
                                 </div>

                                 <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstname">Witness 1</label>
                                            <input type="text" name="witness_1" value="{{ old('witness_1') }}" required class="form-control"  placeholder="witness 1">
                                          </div>
                                          @if ($errors->has('witness_1'))
                                              <div class="text-danger">{{ $errors->first('witness_1') }}</div>
                                           @endif
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstname">Witness 2</label>
                                            <input type="text" name="witness_2" value="{{ old('witness_2') }}" required class="form-control"  placeholder="witness 1">
                                          </div>
                                          @if ($errors->has('witness_2'))
                                              <div class="text-danger">{{ $errors->first('witness_2') }}</div>
                                           @endif
                                    </div>
                                 </div>

                                 <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstname">Credit Start</label>
                                            <input type="date" name="credit_start" value="{{ old('credit_start') }}" required class="form-control" >
                                          </div>
                                          @if ($errors->has('credit_start'))
                                              <div class="text-danger">{{ $errors->first('credit_start') }}</div>
                                           @endif
                                    </div>
                                 </div>

                                 <div class="col-md-3">
                                    <div class="input-group my-1">
                                        <button class="btn btn-primary w-100 fs-6">Add Credit</button>
                                      </div>
                                  </div>

                            </form>

                        </div>


                      </div>


                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <!-- /.card -->
            </div>
            <div class="col-md-4">

                <div class="card">
                    <div class="card-header bg-info">
                        <h2 class="card-title">Loan calculator</h2>
                      </div>

                  <div class="card-body">

                      <div class="tab-content" >
                          <div class="tab-pane container-fluid active" id="addsingleuser">

                              <form action="{{route('manager.loancalculator')}}" method="POST">
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
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="firstname">Credit amount</label>
                                              <input type="text" name="Credit_amount" value="{{ old('Credit_amount') }}" required class="form-control" id="username" placeholder="Enter creadit amount">
                                            </div>
                                            @if ($errors->has('Credit_amount'))
                                                <div class="text-danger">{{ $errors->first('Credit_amount') }}</div>
                                             @endif
                                      </div>


                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="lastname">Credit Duartion in Month</label>
                                              <input type="number" name="credit_duration" value="{{ old ('credit_duration') }}" required class="form-control" id="lastname" placeholder="credit duration in month">
                                            </div>
                                            @if ($errors->has('lastname'))
                                            <div class="text-danger">{{ $errors->first('credit_duration') }}</div>
                                         @endif
                                      </div>
                                   </div>

                                   <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="firstname">Interest Rate</label>
                                              <input type="text" name="interest_rate" value="{{ old('interest_rate') }}" required class="form-control"  placeholder="interest rate in percent">
                                            </div>
                                            @if ($errors->has('interest_rate'))
                                                <div class="text-danger">{{ $errors->first('interest_rate') }}</div>
                                             @endif
                                      </div>
                                   </div>

                                   <div class="col-md-8">
                                    <div class="input-group">
                                        <button class="btn btn-primary w-100 fs-6">Calculate</button>
                                      </div>
                                  </div>







                              </form>

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
