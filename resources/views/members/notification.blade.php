@extends('members.layouts.app')
@section('content')
<div class="wrapper">
     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper bg-white">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container">
            <div class="row mb-2">
              <div class="col-sm-6">

              </div><!-- /.col -->

            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>

        <div class="content">
            <div class="container">

                <section class="content">
                    @foreach ($data as $notification)
                    <div class="d-flex flex-column">
                        <div class="alert alert" role="alert" style="background-color: rgb(155, 218, 243)">
                            <div class="p-0">
                                <p class="fs-5">{{ $notification['Greeting'] }}</p>
                            </div>
                            <div class="d-md-flex flex-md-row flex-md-wrap flex-sm-column align-">
                                <span class="fs-4">{{ $notification['Message'] }}.</span>

                            </div>
                        </div>
                    </div>
                @endforeach

                </section>
            </div>
        </div>

     </div>
</div>

@endsection
