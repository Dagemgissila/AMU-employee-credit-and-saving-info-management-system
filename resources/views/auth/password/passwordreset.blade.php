@extends('auth.layout')

@section('content')


<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center align-items-center mt-5">

        <div class="col-xl-6 col-lg-7 col-md-8 ">

            <div class="card o-hidden border-0 shadow-lg my-4 px-3 ">
                <div class="card-body p-0 ">
                    <!-- Nested Row within Card Body -->
                    <div class="row ">

                        <div class="col-lg-12 py-4">
                            <div class="p-3">
                                <div class="header-text d-flex  justify-content-around align-items-center mt-2" style="width:100%;">
                                    <img src="{{asset ('img/ArbaMinchUniversity-logo_0.gif')}}" class="img-fluid d-none d-md-flex" style="width:16vw;height:17vh;">
                                    <h2 class="text-primary" style="margin-left:1.3em">A.M.U Workers Saving & Credit Association</h2>
                                </div>
                                <hr style="border:1px solid rgb(38, 38, 38);width:100%">

                                <div class="w-100 my-3">
                                   <h2 class="text-primary">Forget Your password?</h2>

                                   <p style="width: 100%">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>
                                </div>



                                <div class="w-100">
                                   <form action="{{route('forget-passwprd.post')}}" method="post">
                                    @csrf
                                    @if(session()->has('success'))
                                    <div class="bg-success text-white">
                                      <p class="p-2 d-flex justify-content-center align-items-center">   {{session('success')}}</p>
                                    </div>
                                    @endif
                                     <div class="form-group">
                                       <label for="">Email address</label>
                                       <input type="email" name="email" class="form-control form-control-lg" placeholder="Enter email">
                                     </div>
                                     @if ($errors->has('email'))
                                     <div class="text-danger">{{ $errors->first('email') }}</div>
                                 @endif

                                     <Button class="btn btn-primary">Reset Password</Button>

                                   </form>
                               </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>


@endsection

