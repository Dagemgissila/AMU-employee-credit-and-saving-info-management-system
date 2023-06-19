@extends('manager.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Saving Account</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>

          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
 </div>

 <div class="modal fade" id="delete-saving" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content ">
        <div class="modal-header">
          <h4 class="modal-title">Confirmation</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="font-weight-bold " id="me">Are you sure you want to delete?</p>
        </div>
        <div class="modal-footer justify-content-between">
            <form action="{{route('delete.saving')}}" method="POST" id="deleteSavingForm">
                @csrf

                <input type="hidden" name="saving_id" id="saving_id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Yes,Delete</button>
              </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>



 <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title"></h3>
            </div>
            @if(session()->has('message'))
              <div class="bg-success text-white">
                <p class="p-2 d-flex justify-content-center  align-items-center ">{{session('message')}}</p>
              </div>
            @endif

            @if ($errors->has('email'))
              <div class="bg-danger text-white">
                <p class="p-2 d-flex justify-content-center font-weight-bold align-items-center lead">{{ $errors->first('email') }}</p>
              </div>
            @endif

            @if ($errors->has('username'))
              <div class="bg-danger text-white">
                <p class="p-2 d-flex justify-content-center font-weight-bold align-items-center lead">{{ $errors->first('username') }}</p>
              </div>
            @endif

            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table class="table table-hover" id="savinglist">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Fullname</th>
                    <th>Saving Amount</th>
                    <th>Saving Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if ($savingdetail->count() > 0)
                  @php
                      $s=0;
                  @endphp
                    @foreach ($savingdetail as $saving)
                      <tr>
                        <td>{{++$s}}</td>
                        @if ($saving->member && $saving->member->user)
                          <td>{{ $saving->member->user->username }}</td>
                        @elseif ($saving->member)
                          <td>N/A</td>
                        @else
                          <td>Invalid member</td>
                        @endif

                        @if ($saving->member)
                          <td>{{ $saving->member->firstname }} {{ $saving->member->middlename }}</td>
                        @else
                          <td>N/A</td>
                        @endif

                        <td>{{ $saving->saving_amount }} birr</td>
                        <td>{{ date('M,j Y', strtotime($saving->saving_month)) }}</td>
                        <td class="d-flex">
                          <a href="" type="button" class="btn btn-primary d-flex align-items-center editbtn btn-sm mx-1">
                            <i class="fa fa-edit"></i> Edit
                          </a>
                          <button type="button" value="{{$saving->id}}" class="btn btn-danger deletebtn btn-sm" data-toggle="modal">
                            <i class="fa fa-trash"></i> Delete
                          </button>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
@endsection

@section('scripts')
<script>
  $(document).ready(function() {
    $(document).on('click','.deletebtn',function() {
      var saving_id=$(this).val();
      $('#saving_id').val(saving_id);
      $('#delete-saving').modal('show');
    });
  });
</script>
@endsection
