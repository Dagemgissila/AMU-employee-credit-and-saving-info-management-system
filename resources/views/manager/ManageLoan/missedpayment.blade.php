@extends('manager.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Overdue Payments</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">

        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
 </div>




 <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <!-- /.card -->

          <div class="card">

            @if(session()->has('message'))
            <div class="bg-success text-white">
              <p class="p-2 d-flex justify-content-center align-items-center">   {{session('message')}}</p>
            </div>
            @endif


            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table class="table table-hover"  id="membertable">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Full Name</th>
                        <th>Payment Amount</th>
                        <th> Payment Date </th>
                        <th>Missed Day</th>
                        <th>Action</th>



                      </tr>
                </thead>
                <tbody>

                    @if ($missedPayment->count() > 0)

                    @php
                        $i=0;

                    @endphp

                    @foreach ($missedPayment as $missed)
                    @php
                    $paidMonth = \Carbon\Carbon::parse($missed->paid_month);
                    $now = \Carbon\Carbon::now();
                    $diff = $paidMonth->diff($now);
                    $formattedDuration = $diff->format('%m month and %d days');
                    $duration = $diff->days > 30 ? $formattedDuration : $diff->days . ' Days';
                @endphp

                    <tr>

                        <td>{{++$i}}</td>
                        <td>{{$missed->credits->member->firstname . " " .$missed->credits->member->middlename. " ". $missed->credits->member->lastname}}</td>
                        <td>{{$missed->paid_amount}} Birr</td>
                        <td>{{$missed->paid_month}}</td>
                        <td>{{ $duration }}</td>
                        <td>
                            <a href="{{route('manager.creditdetail',$missed->credit_id)}}"  type="button" class="btn btn-primary d-flex align-items-center justify-content-center btn-sm mx-1 " >
                                <i class="fa fa-eye p-1"> detail</i>
                            </a>
                          </td>





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
      {{-- edit user --}}

      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>

@endsection









