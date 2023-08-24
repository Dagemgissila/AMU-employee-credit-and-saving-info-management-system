@extends('manager.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Create Account</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
 </div>

   <!-- Main content -->
   <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">

                    <div class="tab-content" >
                        <div class="tab-pane container-fluid active" id="addsingleuser">

                            <form action="{{ route('manager.sellshare')}}" method="POST" >
                             @csrf
                             @if(session()->has('error'))
                             <div class="bg-danger text-white">
                               <p class="p-2 d-flex justify-content-center align-items-center">   {{session('error')}}</p>
                             </div>
                             @endif
                             @if(session()->has('message'))
                             <div class="bg-success text-white">
                               <p class="p-2 d-flex justify-content-center align-items-center">   {{session('message')}}</p>
                             </div>
                             @endif
                                 <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="firstname">Member Name</label>
                                            <input type="text" name="member" id="zmember" class="form-control" list="mems">
                                            <datalist id="mems">
                                               //show all members
                                              @if($members->count()>0)
                                              @foreach($members as $member)

                                                <option value="{{$member->user->username}}">{{$member->firstname}} {{$member->middlename}} {{$member->lastname}}</option>
                                              @endforeach
                                              @endif
                                            </datalist>
                                          </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="username"> Amount</label>
                                            <input type="number" class="form-control" min='1' value="{{ old('username') }}" name="share_amount" placeholder=" enter amount e.g 200" >
                                          </div>
                                          @if ($errors->has('share_amount'))
                                          <div class="text-danger">{{ $errors->first('share_amount') }}</div>
                                      @endif
                                    </div>




                                 </div>

                                 <button class="btn btn-primary">Sell Share</button>
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
