@extends('CreditManager.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">List of user</h1>
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
                        <th>username</th>
                        <th>Full name</th>
                        <th>Share Amount </th>
                        <th>Sold Date</th>

                     </tr>
                </thead>
                <tbody>
                    @if($shares->count() >0)
                    @php
                    $s=0;
                @endphp
                    @foreach ($shares as $share)
                    <tr>
                    <td>{{++$s}}</td>
                    <td>{{$share->member->user->username}}</td>
                    <td>{{$share->member->firstname}} {{$share->member->middlename}} {{$share->member->lastname}}</td>
                    <td>{{$share->share_amount}} Birr</td>
                    <td>{{date('M j, Y',strtotime($share->created_at))}}</td>

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













