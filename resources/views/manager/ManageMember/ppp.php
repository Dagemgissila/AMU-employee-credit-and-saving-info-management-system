@extends('manager.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">List of members</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('manager.dashboard')}}">Home</a></li>

          </ol>
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
            <div class="card-header">

            </div>
            <!-- /.card-header -->
            <div class="card-body ">
              <table id="membertable" class="table table-bordered  table-striped">
                <thead>
                <tr>
                  <th>firstname</th>
                  <th>middlename</th>
                  <th>lastname</th>
                  <th>username</th>
                  <th>phone number </th>
                  <th>bank account</th>
                  <th>salary</th>
                  <th>campus</th>
                  <th>colleage</th>
                  <th>sex </th>
                  <th>martial status</th>
                  <th>registered date</th>
                  <th>action</th>

                </tr>
                </thead>
                <tbody>
                     @if ($members->count() >0)

                    @foreach ($members as $member)
                    <tr>
                        <td>{{$member->firstname}}</td>
                        <td>{{$member->middlename}}</td>
                        <td>{{$member->lastname}}</td>
                        <td>{{$member->user->username}}</td>
                        <td>{{$member->phone_number}}</td>
                        <td>{{$member->bank_account}}</td>
                        <td>{{$member->salary}}</td>
                        <td>{{$member->campus}}</td>
                        <td>{{$member->colleage}}</td>
                        <td>{{$member->sex}}</td>
                        <td>{{$member->martial_status}}</td>
                        <td>{{$member->registered_date}}</td>
                        <td class="d-flex">
                            <button type="button" class="btn btn-primary editbtn btn-sm mx-1 btn-lg" data-toggle="modal">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <button type="button" class="btn btn-danger deletebtn btn-sm btn-lg" data-toggle="modal">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </td>
                     </tr>
                    @endforeach
                    @endif








                </tbody>
                <tfoot>

                </tfoot>
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
  <!-- /.content -->



@endsection
