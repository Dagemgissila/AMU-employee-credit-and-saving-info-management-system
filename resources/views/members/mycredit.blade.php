@extends('members.layouts.app')
@section('content')


<div class="wrapper">



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-white">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <div class="row ">
            <div class="col-sm-6">
              <h3 class="m-0">Credit List</small></h3>
            </div><!-- /.col -->

          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container">
          <div class="row">
            <div class="col-12">

              <!-- /.card -->

              <div class="card">


                </div>
                @if(session()->has('message'))
                <div class="bg-success text-white">
                  <p class="p-2 d-flex justify-content-center align-items-center">   {{session('message')}}</p>
                </div>
                @endif


                <!-- /.card-header -->
                <div class="card-body table-responsive">
                  <table class="table table-hover"  id="mycredit">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Credit Amount</th>
                            <th>Interest Rate</th>
                            <th>Interest Amount</th>

                            <th>Total Payment</th>
                            <th>Credit Start</th>
                            <th>Credit End</th>
                            <th>Witness</th>
                            <th>Status</th>
                            <th>Action</th>

                          </tr>
                    </thead>
                    <tbody>

                        @foreach ($credits as $credit)
                        <tr>
                            <td>1</td>
                            <td>{{auth()->user()->username}}</td>
                            <td>{{$credit->credit_amount}} birr</td>
                            <td>{{$credit->interest_rate}}  %</td>
                            <td>{{$credit->interest_amount}} birr</td>
                            <td>{{$credit->total_payment}} birr</td>
                            <td>{{ date('F j,Y', strtotime($credit->credit_start)) }}</td>
                            <td>{{ date('F j,Y', strtotime($credit->credit_end)) }}</td>
                            <td>{{$credit->witness1}}</td>
                            @if ($credit->credit_status == 0)
    <td><button type="button" class="btn btn-danger btn-sm">Unpaid</button></td>
@else
    <td><button type="button" class="btn btn-success btn-sm">Paid</button></td>
@endif
<td>
    <button type="button" class="btn btn-primary btn-sm d-flex align-items-center" >
        <i class="fa fa-eye px-1"></i> Detail
    </button>
</td>
                        </tr>

                        @endforeach


                       </tbody>
                  </table>
                </div>


          <!-- /.modal -->
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          {{-- edit user --}}

          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->



  </div>
@endsection

