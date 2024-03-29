@extends('admin.layouts.app')
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



                {{-- edit user model --}}
                <div class="modal fade" id="edituser" tabindex="-1" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="{{route('updateaccount')}}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" id="user_id" value=""/>
                            <div class="form-group">
                              <label for="name">username</label>
                              <input type="text" name="username" id="username" required class="form-control"  placeholder="Enter name">
                            </div>
                            <div class="form-group">
                              <label for="email">Email address</label>
                              <input type="email" name="email" required class="form-control"  id="email"  placeholder="Enter email">
                            </div>

                            <button type="submit" class="btn btn-primary">update</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                {{-- end edit user model --}}


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
                            <form action="{{route('admin.deleteaccount')}}" method="POST" id="deleteForm">
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
                             <div class="bg-success p-1 d-flex justify-content-center  align-items-center text-white">
                               <p class=" ">   {{session('message')}}</p>
                             </div>
                             @endif


                         @if($errors->has('email'))
                         <div class="bg-danger p-1 d-flex justify-content-center  align-items-center text-white">
                           <p class=" ">   {{$errors->first('email')}}</p>
                         </div>
                         @endif

                         @if($errors->has('username'))
                         <div class="bg-danger p-1 d-flex justify-content-center  align-items-center text-white">
                           <p class=" ">   {{$errors->first('username')}}</p>
                         </div>
                         @endif



            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table class="table table-hover"  id="usertable">

                <thead>
                <tr>

                  <th>username</th>
                  <th>email</th>
                  <th>role</th>
                  <th>created_at</th>
                  <th>updated_at</th>
                  <th>account status</th>
                  <th>action</th>
                </tr>
                </thead>
                <tbody>

                @if($users->count()>0)
                @foreach ($users as $user)

                <tr>
                  <td>{{$user->username}}
                  </td>
                  <td>@if ($user->email !=null)
                       {{$user->email}}
                       @else
                       <p>no email</p>
                  @endif</td>
                  <td> {{$user->role}}</td>
                  <td>{{$user->getCreatedAt()}}</td>
                  <td>{{$user->getUpdatedAt()}}</td>
                  <td>
                    <form action="{{route('admin.statusUpdate',$user->id)}}" method="POST">
                        @csrf
                        @if($user->account_status == 1)
                            <p class="font-weight-bold text-success">active</p>
                        @else
                        <p class="font-weight-bold text-danger">restricted</p>
                        @endif
                        <input type="hidden" name="status" id="status-input" value="{{ $user->account_status }}">
                    </form>


                  </td>

                  {{-- action --}}
                  <td class="d-flex">
                     <!-- Update button with edit icon -->
                     <form action="{{route('admin.statusUpdate',$user->id)}}" method="POST">
                        @csrf
                        @if($user->account_status == 0)
                            <button type="submit" class="btn btn-success btn-sm mx-1" onclick="document.getElementById('status-input').value = 1;">Active</button>
                        @else
                            <button type="submit" class="btn btn-danger btn-sm mx-1" onclick="document.getElementById('status-input').value = 0;">Restrict</button>
                        @endif
                        <input type="hidden" name="status" id="status-input" value="{{ $user->account_status }}">
                    </form>
                    <a href="{{route('admin.resetpassword',$user->id)}}" type="button" class="btn btn-warning btn-sm mx-1">
                        <i class="fas fa-key"></i> Reset Password
                    </a>
                <button type="button" value="{{$user->id}}" class="btn btn-danger deletebtn btn-sm"  data-toggle="modal" >
                    <i class="fa fa-trash"></i> Delete
                  </button>



{{-- endaction --}}
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

@section('scripts')
<script>
    $(document).ready(function (){
            $(document).on('click','.editbtn',function(){
                var user_id=$(this).val();
                $('#edituser').modal('show');

                $.ajax({
                  type:"GET",
                  url: "/updateaccount/"+user_id,
                  success: function (response) {
                    $('#username').val(response.user.username);
                    $('#email').val(response.user.email);
                    $('#user_id').val(user_id);

                    }

                });
            });
    });



    $(document).ready(function (){
            $(document).on('click','.deletebtn',function(){
                var userr_id=$(this).val();
                $('#delete-user').modal('show');

                $.ajax({
                  type:"GET",
                  url: "/deleteaccount/"+userr_id,
                  success: function (response) {

                    $('#userr_id').val(userr_id);

                    }

                });


            });
    });

</script>
@endsection





