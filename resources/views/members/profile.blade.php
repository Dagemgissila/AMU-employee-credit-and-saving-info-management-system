@extends('members.layouts.app')
@section('content')
<div class="wrapper">
   <div class="content-wrapper">
    <div class="content">
        <div class="container">
            <div class="row mt-2 p-2">
                <div class="col-md-12 mx-auto">
                  <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title">Personal Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="d-flex">
                              <strong>Fullname:</strong>
                              <p class="text-muted ml-2"><i class="fas fa-user px-1"></i> {{$member->firstname." ". $member->middlename." ".$member->lastname}}</p>
                            </div>
                            <hr>
                            <div class="d-flex">
                              <strong>Email:</strong>
                              <p class="text-muted ml-2"><i class="fas fa-envelope px-1"></i> {{auth()->user()->email}}</p>
                            </div>
                            <hr>
                            <div class="d-flex">
                                <strong>Phone Number:</strong>
                                <p class="text-muted ml-2"><i class="fas fa-phone"></i> {{$member->phone_number}}</p>
                              </div>
                            <hr>
                          </div>
                          <div class="col-md-6">
                            <div class="d-flex">


                            </div>
                            <hr>
                            <div class="d-flex">
                              <strong>Campus:</strong>
                              <p class="text-muted ml-2"><i class="fas fa-map-marker-alt px-1"></i> {{$member->campus}}</p>
                            </div>
                            <hr>
                            <div class="d-flex">
                              <strong>Marital status:</strong>
                              <p class="text-muted ml-2"><i class="fas fa-heart px-1"></i> {{$member->martial_status}}</p>
                            </div>
                            <hr>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="d-flex">
                              <strong>Saving Percent:</strong>
                              <p class="text-muted ml-2"><i class="fas fa-percent px-1"></i> {{$member->saving_percent}}</p>
                            </div>
                            <hr>
                          </div>
                          <div class="col-md-6">
                            <div class="d-flex">
                              <strong>Salary:</strong>
                              <p class="text-muted ml-2"><i class="fas fa-money-bill-wave px-1"></i> {{$member->salary}} birr</p>
                            </div>
                            <hr>
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
