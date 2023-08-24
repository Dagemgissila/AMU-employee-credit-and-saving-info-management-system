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
                        <th>FirstName</th>
                        <th>MiddleName</th>
                        <th>LastName</th>
                        <th>UserName</th>
                        <th>PhoneNumber </th>
                        <th>BankAccount</th>
                        <th> Salary </th>
                        <th>SavingPercent</th>
                        <th>ShareBalance</th>
                        <th>SavingBalance</th>
                        <th>Campus</th>
                        <th>Colleage</th>
                        <th>Sex</th>
                        <th>MartialStatus</th>
                        <th>RegisteredDate</th>
                        <th>Action</th>

                      </tr>
                </thead>
                <tbody>

                    @if ($members->count() >0)

                    @php
                        $i=0;
                    @endphp

                    @foreach ($members as $member)

                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$member->firstname}}</td>
                        <td>{{$member->middlename}}</td>
                        <td>{{$member->lastname}}</td>
                        <td>{{$member->user->username}}</td>
                        <td>{{$member->phone_number}}</td>
                        <td>{{$member->bank_account}}</td>
                        <td>{{number_format($member->salary,2)}} Birr</td>
                        <td>{{ $member->saving_percent }}  %</td>
                        <td>
                            @php
                            //Updated sum('saving_balance') to sum('saving_amount')
                              $totalBalanc = $member->shares->sum('share_amount');
                              echo number_format($totalBalanc,2) ;
                            @endphp

                            Birr
                          </td>
                        <td>
                            @php
                            //Updated sum('saving_balance') to sum('saving_amount')
                              $totalBalance = $member->savingAccounts->sum('saving_amount');
                              echo number_format($totalBalance ,2);
                            @endphp

                            Birr
                          </td>


                        <td>{{$member->campus}}</td>
                        <td>{{$member->colleage}}</td>
                        <td>{{$member->sex}}</td>
                        <td>{{$member->martial_status}}</td>
                        <td>{{date('M j, Y,',strtotime($member->registered_date))}}</td>
                        <td class="d-flex">
                            <a href="{{route('manager.editMember',$member->id)}}"  type="button" class="btn btn-primary d-flex align-items-center editbtn btn-sm mx-1 " >
                                <i class="fa fa-edit"></i> Edit
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









