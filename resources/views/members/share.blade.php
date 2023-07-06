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
              <h3 class="m-0">Member Name : {{ $member->firstname}} {{$member->middlename}} {{$member->lastname}}  </small></h3>
              <h3 class="m-0">Total Share  : {{ $share}}  ETB</small></h3>
            </div>
            <!-- /.col -->

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
