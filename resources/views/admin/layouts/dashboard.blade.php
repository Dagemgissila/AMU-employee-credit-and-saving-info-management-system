@extends('admin.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>

          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
 </div>

   <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
   <div class="row">

    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>150</h3>

          <p>Total members</p>
        </div>
        <div class="icon">
          <i class="ion ion-user"></i>
        </div>

      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>53</h3>

          <p>Borrowers</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>

      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>100</h3>

          <p>Message</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>

      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>65</h3>

          <p>Block user</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>

      </div>
    </div>
    <!-- ./col -->
  </div>
</div><!-- /.container-fluid -->
</section>
@endsection
