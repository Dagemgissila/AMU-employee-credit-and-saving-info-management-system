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
                <h1 class="m-0"> Request Credit</small></h1>
              </div><!-- /.col -->

            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>

        <div class="content">
            <div class="container">
                <section class="content">
                    @foreach ($data as $notification)
                    <div class="d-flex p-1 flex-column rounded" style="background-color: #F0F8FF">
                        <div class="p-0">
                            <span>Title: {{ $notification['subject'] }}</span>
                        </div>
                        <div class="d-md-flex flex-md-row flex-md-wrap flex-sm-column align-">
                            <span>{{ $notification['Message'] }}.</span>
                            <p class="d-flex p-0">{{$notification['loan amount']}} Birr is Allowed for {{$notification['duration']}} months .
                                <p class="p-0 m-0">You Can find Your Witness Using This Link
                                     <form action="{{route('member.seachWitness')}}" method="POST">
                                          @csrf
                                        <input type="hidden" name="credit_amount" value="{{$notification['loan amount']}}" id="">
                                        <input type="hidden" name="credit_duration" value="{{$notification['duration']}}">
                                        <button class="btn btn-sm p-0 btn-info">Find Witness</button>

                                     </form>
                                </p>
                            </p>
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
