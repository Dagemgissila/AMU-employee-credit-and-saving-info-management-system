@extends('manager.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>

          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
 </div>



  <!-- Tab panes -->


   <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

              <div class="card">


                <div class="card-body">

                    <div class="tab-content" >
                        <div class="tab-pane container-fluid active" id="addsingleuser">

                            <form action="{{route('manager.editMember',$member->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                @if(session()->has('message'))
                                <div class="bg-success text-white">
                                  <p class="p-2 d-flex justify-content-center align-items-center">   {{session('message')}}</p>
                                </div>
                                @endif
                                @if(session()->has('error'))
                                <div class="bg-danger text-white">
                                  <p class="p-2 d-flex justify-content-center align-items-center">   {{session('error')}}</p>
                                </div>
                                @endif


                                 <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="firstname">Fisrt Name</label>
                                            <input type="text" name="firstname" value="{{$member->firstname}}" required class="form-control" id="firstname" placeholder="first name">
                                          </div>
                                          @if ($errors->has('firstname'))
                                              <div class="text-danger">{{ $errors->first('firstname') }}</div>
                                           @endif
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="middlename">Middle Name</label>
                                            <input type="text" name="middlename" value="{{$member->middlename}}" required class="form-control" id="middlename" placeholder="middle name">
                                          </div>
                                          @if ($errors->has('middlename'))
                                          <div class="text-danger">{{ $errors->first('middlename') }}</div>
                                       @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lastname">Last Name</label>
                                            <input type="text" name="lastname" value="{{$member->lastname}}" required class="form-control" id="lastname" placeholder="last name">
                                          </div>
                                          @if ($errors->has('lastname'))
                                          <div class="text-danger">{{ $errors->first('lastname') }}</div>
                                       @endif
                                    </div>
                                 </div>

                                 <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="username">Saving percent</label>
                                            <input type="text" name="SavingPercent" value="{{ $member->saving_percent}}" required class="form-control" id="username" placeholder="e.g. 1364">

                                          </div>
                                          @if ($errors->has('SavingPercent'))
                                          <div class="text-danger">{{ $errors->first('SavingPercent') }}</div>
                                       @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="accountnumber">Bank Account Number</label>
                                            <input type="number" name="bankaccount" value="{{ $member->bank_account}}" required class="form-control" id="accountnumber" placeholder=" e.g 1000356...">
                                          </div>
                                          @if ($errors->has('bankaccount'))
                                          <div class="text-danger">{{ $errors->first('bankaccount') }}</div>
                                       @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="phonenumber">Phone Number</label>
                                            <input type="number" name="phonenumber" value="{{ $member->phone_number}}" required class="form-control" id="lastname" placeholder=" e.g 09547***">
                                          </div>
                                          @if ($errors->has('phonenumber'))
                                          <div class="text-danger">{{ $errors->first('phonenumber') }}</div>
                                       @endif
                                    </div>
                                 </div>
                                 <hr>

                                 <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="salary">Salary</label>
                                            <input type="number"name="salary" required  value="{{ $member->salary}}"  class="form-control" id="salary" placeholder=" e.g 15000.00">
                                          </div>
                                          @if ($errors->has('salary'))
                                          <div class="text-danger">{{ $errors->first('salary') }}</div>
                                       @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="campus">campus</label>
                                            <select class="form-control" required name="campus" style="width: 100%;">
                                                <option value="">-- Please select a campus --</option>
                                                <option value="main" {{ $member->campus == 'main' ? 'selected' : '' }}>Main</option>
                                                <option value="kulfo" {{ $member->campus == 'kulfo' ? 'selected' : '' }}>Kulfo</option>
                                                <option value="nechsar" {{ $member->campus == 'nechsar' ? 'selected' : '' }}>Nechsar</option>
                                                <option value="abaya" {{ $member->campus == 'abaya' ? 'selected' : '' }}>Abaya</option>
                                                <option value="chamo" {{ $member->campus == 'chamo' ? 'selected' : '' }}>Chamo</option>
                                                <option value="sawula" {{ $member->campus == 'sawula' ? 'selected' : '' }}>Sawula</option>
                                            </select>
                                          </div>
                                          @if ($errors->has('campus'))
                                          <div class="text-danger">{{ $errors->first('campus') }}</div>
                                       @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="colleage">colleage</label>
                                            <select class="form-control " required name="colleage" style="width: 100%;">
                                                <option value="">-- Please select a colleage --</option>
                                                <option value="AMIT" {{$member->colleage == "AMIT"? ' selected' : ''}}>AMIT</option>
                                                <option value="AWIT" {{$member->colleage == 'AWIT' ? 'selected' : ''}}>AWIT</option>
                                                <option value="MEDICAL" {{$member->colleage == 'MEDICAL' ? 'selected' : ''}}>MEDICAL</option>
                                              </select>
                                          </div>
                                          @if ($errors->has('colleage'))
                                          <div class="text-danger">{{ $errors->first('colleage') }}</div>
                                       @endif
                                    </div>

                                 </div>

                                 <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sex">sex</label>
                                            <select class="form-control" required name="sex" style="width: 100%;">
                                                <option value="">-- Please select a sex --</option>
                                                <option value="female" {{ $member->sex == 'female' ? 'selected' :''}}>Female</option>
                                                <option value="male" {{$member->sex == 'male' ? 'selected' : ''}}>Male</option>


                                              </select>
                                              @if ($errors->has('sex'))
                                              <div class="text-danger">{{ $errors->first('sex') }}</div>
                                           @endif
                                          </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="marriage">martial status</label>
                                            <select class="form-control" required  name="martial_status" style="width: 100%;">
                                                <option value="">-- Please select a martial status --</option>
                                                <option value="married" {{ $member->martial_status == 'married' ? 'selected' :''}}>married</option>
                                                <option value="single" {{ $member->martial_status == 'single' ? 'selected' :''}}>Single</option>
                                              </select>
                                              @if ($errors->has('martial_status'))
                                              <div class="text-danger">{{ $errors->first('martial_status') }}</div>
                                           @endif
                                          </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="date">Registered Date</label>
                                            <input type="date" name="registered_date" value="{{ date('Y-m-d', strtotime($member->registered_date)) }}" required class="form-control" id="date">
                                            @if ($errors->has('registered_date'))
                                                <div class="text-danger">{{ $errors->first('registered_date') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                  <div class="col-md-2">
                                    <div class="input-group my-3">
                                        <button class="btn btn-primary w-100 fs-6">Update member</button>
                                      </div>
                                  </div>
                                 </div>
                            </form>

                        </div>


                      </div>


                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->


              <!-- /.card -->

            </div>

            <!-- /.col (right) -->
          </div>
</div><!-- /.container-fluid -->
</section>
@endsection
