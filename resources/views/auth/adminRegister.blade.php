@extends('auth.layout')

@section('content')

  <!----------------------- Main Container -------------------------->
  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <!----------------------- Login Container -------------------------->
       <div class="row border rounded-5 p-md-4 p-2 bg-white shadow box-area">
    <!--------------------------- Left Box ----------------------------->
       <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #103cbe;">
        <p class="text-white text-wrap text-center py-2" style="width: 20rem;font-weight:bold">AMU emplyee credit and saving information management system</p>
           <div class="featured-image mb-3">

            <img src="https://upload.wikimedia.org/wikipedia/en/e/ef/Arba_Minch_University.png" class="img-fluid" style="width: 250px;">
           </div>

       </div>
    <!-------------------- ------ Right Box ---------------------------->

       <div class="col-md-6 right-box">
          <div class="row align-items-center">
                <div class="header-text mb-4" style="width:100%">
                     <h2>Sign In</h2>
<hr style="font-weight:bold:">
                </div>
                <div class="input-group mb-3">

                    <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Email address">
                </div>
                <div class="input-group mb-1">

                    <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password">
                </div>
                <div class="input-group mb-5 d-flex justify-content-between">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="formCheck">
                        <label for="formCheck" class="form-check-label text-secondary"><small>Remember Me</small></label>
                    </div>
                    <div class="forgot">
                        <small><a href="#">Forgot Password?</a></small>
                    </div>
                </div>
                <div class="input-group mb-5">
                    <button class="btn btn-lg btn-primary w-100 fs-6">Login</button>
                </div>

          </div>
       </div>
      </div>
    </div>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');
       body{
           font-family: 'Poppins', sans-serif;
       =
      background-size: cover;
      background-repeat: no-repeat;
      height: 100vh;

       }
       /*------------ Login container ------------*/
       .box-area{
           width: 930px;
       }
       /*------------ Right box ------------*/
       .right-box{
           padding: 40px 30px 40px 40px;
       }
       /*------------ Custom Placeholder ------------*/
       ::placeholder{
           font-size: 16px;
       }
       .rounded-4{
           border-radius: 10px;
       }
       .rounded-5{
           border-radius: 20px;
       }
    .header-text h2{
        font-weight: bold;
        font-family: 'Bai Jamjuree', sans-serif;
    }
    .header-text hr{
        font-weight: bold;
        border: 1px solid rgb(38, 38, 38);
    }
       /*------------ For small screens------------*/
       @media only screen and (max-width: 768px){
            .box-area{
               margin: 0 10px;
            }
            .featured-image{
               display: none;
            }
            .right-box{
               padding: 20px;
            }
            .rounded-4{
           border-radius: 0px;

       }

       }
       </style>
@endsection
