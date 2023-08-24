@extends('manager.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">List of Witness</h1>
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



            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table class="table table-hover"  id="membertable">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Borrower Fullname</th>
                        <th>Wittness 1</th>
                        <th>Witness 2</th>

                        <th>Credit Status</th>
                        <th>action</th>

                      </tr>
                </thead>
                <tbody>

                    @if ($witness->count() > 0)


                    @php
                        $i=0;

                    @endphp

                    @foreach ($witness as $wtn)

                    <tr>

                        <td>{{++$i}}</td>
                        <td>{{$wtn->member->firstname . " ". $wtn->member->middlename ." ". $wtn->member->lastname}} </td>
                        <td>
                            @if ($wtn->witness1 === null)
                               No Witness
                            @else

                              {{$wtn->witness1}}
                            @endif
                        </td>
                        <td>
                          @if ($wtn->witness2 === null)
                            No Witness
                         @else


                           {{$wtn->witness2}}
                         @endif
                        </td>

                        <td class="">
                            @if($wtn->credit_status == 0)
                                <span class="bg-danger p-1 font-weight-bold">unpaid</span>
                            @else
                            <span class="bg-success p-1 font-weight-bold">paid</span>
                            @endif
                        </td>


                          <td>
                            <a href="{{route('manager.creditdetail',$wtn->id)}}"  type="button" class="btn btn-primary d-flex align-items-center justify-content-center btn-sm mx-1 " >
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









