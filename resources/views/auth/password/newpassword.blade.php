@extends('auth.layout')

@section('content')

  <!----------------------- Main Container -------------------------->
  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <!----------------------- Login Container -------------------------->

       <div class="row  bg-white rounded  w-100">
    <!--------------------------- Left Box ----------------------------->

    <!-------------------- ------ Right Box ---------------------------->

       <div class="col-md-6 left d-flex align-items-center  flex-column p-3 p-sm-4 my-5">

        <div class="header-text d-flex  justify-content-around align-items-center mt-3" style="width:100%;">
            <img src="img/ArbaMinchUniversity-logo_0.gif" class="img-fluid" style="width:90px;height:90px;">
            <p class="text-wrap text-left" style="width: 20rem;font-weight:bold;margin:0;">AMU employee credit and saving information management system</p>
          </div>

          <hr style="border:1px solid rgb(38, 38, 38);width:100%">

         <div class="w-100 my-3">
            <h2 class="text-primary float-left">Reset Password</h2>
         </div>




         <div class="w-100">
            <form action="/addmembers" method="get">
                @csrf
              <div class="form-group">
                <label for="exampleInputEmail1">new password</label>
                <input type="password" class="form-control form-control"  placeholder="Enter new password">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">confirm password</label>
                <input type="password" class="form-control form-control"   placeholder="Confirm password">
              </div>

              <div class="input-group mb-5">
                <button class="btn btn-lg btn-primary w-100 fs-6">continue</button>
              </div>

            </form>
          </div>



       </div>

       <div class=" col-md-6 right rounded-4 d-flex justify-content-center align-items-center flex-column ">

           <div class="featured-image mb-3 d-none d-md-block">
            <img src="img/Reset password.gif" class="img-fluid" style="width:100%;height:100%;">

           </div>

       </div>
      </div>
    </div>


@endsection
