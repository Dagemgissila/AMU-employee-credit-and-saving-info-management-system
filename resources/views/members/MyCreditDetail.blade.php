@extends('members.layouts.app')

        @section('content')
        <div class="wrapper">



            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper bg-white">
              <!-- Content Header (Page header) -->
<section class="content p-3">
    <div class="container">
         <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Credit Detail Information</h3>
              </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                          <p><span class="font-weight-bold mx-3">Username :</span> <span>{{$credit->member->user->username}}</span></p>

                          <p><span class="font-weight-bold mx-3">FullName :</span> <span>{{$credit->member->firstname. " " . $credit->member->middlename . " ".$credit->member->lastname}}</span></p>
                          <p><span class="font-weight-bold mx-3">Credit Amount :</span> <span>{{$credit->credit_amount}} Birr</span></p>
                          <p><span class="font-weight-bold mx-3">Interest Rate :</span> <span>{{$credit->interest_rate}} %</span></p>
                          <p><span class="font-weight-bold mx-3"> Interest Amount :</span> <span>{{$credit->interest_amount}} Birr</span></p>
                    </div>

                    <div class="col-md-6">
                        <p><span class="font-weight-bold mx-3">Total Payment :</span> <span>{{$credit->total_payment}} Birr</span></p>

                        <p><span class="font-weight-bold mx-3">Witness 1:</span> <span>

                            @if($credit->witness1)
                                 <span>{{$credit->witness1}}</span>
                            @else
                                  <span> No Witness</span>
                            @endif

                        </span></p>

                        <p><span class="font-weight-bold mx-3">Witness 1:</span> <span>

                            @if($credit->witness1)
                                   <span>{{$credit->witness2}}</span>
                              @else
                             <span> No Witness</span>
                                 @endif
                             </span>
                          </p>

                          <p><span class="font-weight-bold mx-3">Total Paid Amount :</span> <span class="bg-green px-1">{{$paidamount}} Birr</span></p>
                          <p><span class="font-weight-bold mx-3"> Unpaid Amount  :</span> <span class="bg-danger px-1"> @if ($credit->total_payment - $paidamount <=0 )
                             0
                             @else
                             {{$credit->total_payment - $paidamount}}
                          @endif  Birr</span></p>

                    </div>
                </div>
            </div>

         </div>

         <div class="row my-4">
            <div class="col-12">

              <!-- /.card -->
              <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Credit Payment History</h3>
                  </div>
                              @if(session()->has('message'))
                                 <div class="bg-success p-1 d-flex justify-content-center  align-items-center text-white">
                                   <p class=" ">   {{session('message')}}</p>
                                 </div>
                                 @endif

                <!-- /.card-header -->
                <div class="card-body table-responsive">
                  <table class="table table-hover"  id="usertable">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Paid Amount</th>
                      <th>Payment Date</th>
                      <th>Payment Status</th>
                    </tr>
                    </thead>
                    <tbody>

                        @if($creditrepayments ->count() > 0)

                           @php
                              $i=0;

                             @endphp

                        @foreach ($creditrepayments as $creditrepayment)

                    <tr>
                      <td>{{++$i}}</td>
                      <td>{{$creditrepayment->paid_amount}} Birr</td>
                      <td> {{$creditrepayment->paid_month}}</td>
                      <td>@if ($creditrepayment->status==1)
                           <span class="text-success p-1 font-weight-bold">Payed</span>
                           @else
                           <span class="text-danger p-1 font-weight-bold">Un Payed</span>
                      @endif
                    </td>
                      <td>





                    </tr>

                    @endforeach

                        @endif
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
    </div>
</section>
    </div>
</div>
@endsection
