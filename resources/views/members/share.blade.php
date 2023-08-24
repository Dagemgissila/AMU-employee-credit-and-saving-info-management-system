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

            </div>
            <!-- /.col -->

          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container ">
          <div class="row">
            <div class="col-12">

              <!-- /.card -->

              <div class="card">

                <div class="card-header">
                    <p class="m-0 font-weight-bold">Member Name : {{ $member->firstname}} {{$member->middlename}} {{$member->lastname}}  </small></p>
                    <p class="m-0 font-weight-bold">Total Savings  : {{ $shareAmount}}  ETB</small></p>
                </div>
                 @if(session()->has('message'))
                <div class="bg-success text-white">
                  <p class="p-2 d-flex justify-content-center align-items-center">   {{session('message')}}</p>
                </div>
                @endif


                <!-- /.card-header -->
                <div class="card-body table-responsive ">
                  <table class="table table-hover" >

                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th> Year</th>
                            <th>Month </th>
                            <th>Amount in ETB</th>

                          </tr>
                    </thead>
                    <tbody>
                        @foreach ($share as $index => $s)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                             <td>{{ substr($s->created_at, 0, 4) }}</td>
                            <td>{{ date("F j", strtotime($s->created_at)) }}</td>
                            <td>{{ $s->share_amount }} Birr</td>

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
