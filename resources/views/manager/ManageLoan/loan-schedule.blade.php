@extends('manager.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">List of user</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>

          </ol>
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
            <div class="card-header">
                <h1>Loan Repayment Schedule</h1>
                <p><strong>Loan Amount:</strong> {{ $loanAmount }} birr</p>
                <p><strong>Loan Term in Months:</strong> {{ $loanTermInMonths }} months</p>
                <p><strong>Interest Rate:</strong> {{ $interestRate }}%</p>
                <p><strong>Monthly Payment without Interest:</strong> {{ $principal }} birr</p>
                <p><strong>Total Payment:</strong> {{ number_format($loanAmount + array_sum(array_column($loanSchedule, 'interest')), 2) }} birr</p>
                <a href="{{route('manager.addcredit')}}" type="submit" class="btn btn-primary">Back</a>
            </div>

            @if(session()->has('message'))
            <div class="bg-success text-white">
              <p class="p-2 d-flex justify-content-center align-items-center">   {{session('message')}}</p>
            </div>
            @endif

                             @if ($errors->has('email'))
                             <div class="bg-danger text-white">
                                <p class="p-2 d-flex justify-content-center font-weight-bold align-items-center lead"> {{ $errors->first('email') }}</p>
                             </div>
@endif
                             @if ($errors->has('username'))
                             <div class="bg-danger text-white">
                                <p class="p-2 d-flex justify-content-center font-weight-bold align-items-center lead"> {{ $errors->first('username') }}</p>
                             </div>

                         @endif
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table class="table table-hover"  id="membertable">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Due Date</th>
                        <th>Principal</th>
                        <th>Interest</th>
                        <th>Due</th>
                        <th>Principal Balance </th>



                      </tr>
                </thead>
                <tbody>



                    @php
                        $i=0;
                    @endphp

                    @foreach ($loanSchedule as $schedule)

                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{ $schedule['due_date'] }}</td>

				<td>{{ $schedule['principal'] }}</td>
				<td>{{ $schedule['interest'] }}</td>
				<td>{{ $schedule['due'] }}</td>
				<td>{{ $schedule['principal_balance'] }}</td>


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

@endsection









