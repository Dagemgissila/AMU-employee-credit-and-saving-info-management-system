@extends('manager.layouts.app')
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

                <div class="modal fade" id="delete-user" tabindex="-1" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content ">
                        <div class="modal-header">
                          <h4 class="modal-title">Confirmation</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p class="font-weight-bold " id="me">Are you sure you want to delete this user?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <form action="{{route('deleteaccount')}}" method="POST" id="deleteForm">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="user_id" id="userr_id">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                              </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>

                  {{-- enddelete model --}}


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
                        <th>Credit Id</th>
                        <th>Full Name</th>
                        <th>username</th>
                        <th>Credit Amount</th>
                        <th> Total Payment </th>
                        <th>Credit Start</th>
                        <th>Credit End</th>
                        <th>Credit Status</th>
                        <th>Action</th>


                      </tr>
                </thead>
                <tbody>

                    @if ($credits->count() > 0)

                    @php
                        $i=0;

                    @endphp

                    @foreach ($credits as $credit)

                    <tr>

                        <td>{{++$i}}</td>
                        <td>{{$credit->id}}</td>
                        <td>{{$credit->member->firstname . " ". $credit->member->middlename ." ". $credit->member->lastname}} </td>
                        <td>{{$credit->member->user->username}}</td>
                        <td>{{number_format($credit->credit_amount,2)}} Birr</td>
                        <td>{{ $credit->total_payment }}  Birr </td>
                        <td>
                         {{$credit->credit_start}}
                          </td>
                        <td>
                            {{$credit->credit_end}}
                          </td>
                          <td class="d-flex justify-content-center">
                              @if($credit->credit_status == 0)
                                  <span class="bg-danger p-1 font-weight-bold">unpaid</span>
                              @else
                              <span class="bg-success p-1">paid</span>
                              @endif
                          </td>
                          <td>
                            <a href="{{route('manager.creditdetail',$credit->id)}}"  type="button" class="btn btn-primary d-flex align-items-center justify-content-center btn-sm mx-1 " >
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









