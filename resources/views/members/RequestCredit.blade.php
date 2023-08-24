@extends('members.layouts.app')
@section('content')
<div class="wrapper">
     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper bg-white">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0"> Request Credit</small></h1>
              </div><!-- /.col -->

            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>

        <div class="content">
            <div class="container">
                <section class="content">
                    <div class="container-fluid">
                      <div class="card">
                        @if(session()->has('message'))
                        <div class="bg-success text-white">
                          <p class="p-2 d-flex justify-content-center align-items-center">   {{session('message')}}</p>
                        </div>
                        @endif
                             @if($diffMonth < 6)
                             <div class=" p-3 text-center" style="background-color: #F0F8FF">
                                <p> you are unable to request a loan at this time. To be eligible for a loan, you must have been a member for a minimum of six months.</p>
                            </div>

                             @else

                                 @if($creditExist ===true  || $requestExist===true)
                                        @if ($creditExist)
                                        <div class=" p-3 text-center  float-left " style="background-color: #F0F8FF">
                                            <p>We regret to inform you that you have an unpaid loan. Please note that new loan requests cannot be processed
                                                 until you have completely paid off your existing loan.
                                            </p>
                                          </div>
                                          @else
                                          <div class=" p-3 text-center  float-left " style="background-color: #F0F8FF">
                                            <p> You already Send Request
                                            </p>
                                          </div>
                                        @endif
                                 @else
                                 <div class="card-body">
                                    <form action="{{route('member.RequestCredit')}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="creditamount">Credit Amount</label>
                                                    <input type="text" name="credit_amount" value="" required class="form-control" id="creditamount" placeholder="Credit Amount">
                                                </div>
                                                @if ($errors->has('credit_amount'))
                                                <div class="text-danger">{{ $errors->first('credit_amount') }}</div>
                                            @endif
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="duration">Credit Duartion In Month</label>
                                                    <input type="text" name="credit_duration" value="" required class="form-control" id="duration" placeholder="Credit Duration">
                                                </div>
                                                @if ($errors->has('credit_duration'))
                                                <div class="text-danger">{{ $errors->first('credit_duration') }}</div>
                                            @endif
                                            </div>

                                                    <button class="btn form-control btn-primary">Send Request</button>

                                        </div>
                                    </form>
                                  </div>
                                 @endif

                             @endif
                      </div>
                    </div>
                </section>
            </div>
        </div>

     </div>
</div>

@endsection
