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
              <h3 class="m-0">Total Saving Balance : {{ $totalAmount}}  birr</small></h3>
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
                  <table class="table table-hover"  id="savingtable">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Firstname</th>
                            <th>Middlename</th>
                            <th>Lastname</th>

                            <th>Saving Amount</th>
                            <th>Year</th>
                            <th>Saving Month</th>

                          </tr>
                    </thead>
                    <tbody>
                        @foreach ($savingAccounts as $index => $account)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $member->user->username }}</td>
                            <td>{{ $member->firstname }}</td>
                            <td>{{ $member->middlename }}</td>
                            <td>{{ $member->lastname }}</td>
                            <td>{{ $account->saving_amount }}</td>
                            <td>{{ substr($account->saving_month, 0, 4) }}</td>
                            <td>{{ date("F j", strtotime($account->saving_month)) }}</td>
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
