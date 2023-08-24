@extends('manager.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Add credit</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">

        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
 </div>

 <div class="modal fade" id="member-info-modal" tabindex="-1" role="dialog" aria-labelledby="member-info-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title d-flex align-items-center justify-content-center" id="member-info-modal-label">
                    <i class="fas fa-user-circle fa-3x mr-2"></i> Member Info
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p><strong>Full Name:</strong> <span id="member-name"></span></p>
                <p><strong>Phone Number:</strong> <span id="member-phonenumber"></span></p>
                <p><strong>Campus:</strong> <span id="member-campus"></span> Campus</p>

                <p><strong>Total Saving Amount:</strong> <span id="member-saving"> </span> Birr</p>
                <p><strong>Total Share Amount:</strong> <span id="member-share"> </span> Birr</p>
                <!-- ... other member info fields -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<section class="content">
    <div class="container-fluid">
        <div class="row my-4">
            <div class="col-12">

              <!-- /.card -->
              <div class="card ">


                @if(session()->has('message'))
                                 <div class="bg-success p-1 d-flex justify-content-center  align-items-center text-white">
                                   <p class=" ">   {{session('message')}}</p>
                                 </div>
                                 @endif

                <!-- /.card-header -->
                <div class="card-body table-responsive">
                  <table class="table table-hover">

                    <thead>
                    <tr>

                      <th>No</th>
                      <th>Requested BY</th>
                      <th>Requested Amount</th>
                      <th>Credit Duration</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>


                        @if($RequestCredits ->count() > 0)

                           @php
                              $i=0;

                             @endphp

                        @foreach ($RequestCredits as $credit)

                    <tr>
                      <td>{{++$i}}</td>
                      <td>{{ $credit->member->firstname  . " " . $credit->member->middlename . " " . $credit->member->lastname}}</td>
                      <td> {{$credit->request_amount}} Birr</td>
                      <td>{{$credit->duration_in_month}} Months</td>
                      <td>
                           @if($credit->status ==0)
                                <p class="text-danger font-weight-bold">pending</p>
                           @else
                           <p class="text-success font-weight-bold">Approved</p>
                           @endif
                      </td>
                      <td class="d-flex">

                        <button class="btn btn-info btn-sm d-flex align-items-center btn-view-member-info" data-member-id="{{$credit->member_id}}">
                            <i class="fas fa-user"></i> View Member Info
                        </button>

                        <form action="{{route('manager.ApprovedCreditRequest',$credit->id)}}" method="POST">
                            @csrf
                            @if ($credit->status==1)
                                <button type="submit" disabled class="btn btn-danger d-flex align-items-center deletebtn btn-sm mx-1" data-toggle="modal">
                                    <i class="fas fa-check-circle"></i> Approved
                                </button>
                            @else
                                <input type="hidden" name="user_id" value="{{$credit->member->user_id}}">
                                <input type="hidden" name="credit_amount" value="{{$credit->request_amount}}">
                                <input type="hidden" name="credit_duration" value="{{$credit->duration_in_month}}">
                                <button type="submit" class="btn btn-success d-flex align-items-center deletebtn btn-sm mx-1" data-toggle="modal">
                                    <i class="fas fa-check"></i> Approve Request
                                </button>
                            @endif
                        </form>



                    </tr>

                    @endforeach

                        @endif
                       </tbody>
                  </table>
                </div>


          <!-- /.modal -->
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
    $(document).on('click', '.btn-view-member-info', function() {
    var memberId = $(this).data('member-id');

    // Make an AJAX request to the route
    $.ajax({
        url: '/manager/member-info/' + memberId,
        type: 'GET',
        success: function(response) {
            var member = response.member;
            var saving = response.saving;
            var share=response.share;

            // Display the member info in the modal
            $('#member-name').text(member.firstname + ' ' + member.middlename + ' ' + member.lastname);
            $('#member-phonenumber').text(member.phone_number);
            $('#member-campus').text(member.campus);
            $('#member-saving').text(saving);
            $('#member-share').text(share);

            // ... other member info fields

            // Show the modal
            $('#member-info-modal').modal('show');
        },
        error: function() {
            alert('Error retrieving member info.');
        }
    });
});
</script>

@endsection
