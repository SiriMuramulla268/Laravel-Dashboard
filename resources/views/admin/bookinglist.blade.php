@extends('layouts.master')
@section('title',config('app.name'))
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <div class="col-sm-10"><h3>Bookings</h3></div>
                </div>
                    <br>
                <table id="table_booking" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Booking ID</th>
                    <th>Hotel</th>
                    <th>User</th>
                    <th>Check-In</th>
                    <th>Check-Out</th>
                    <th>Amount</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      
                  </tbody>
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

     <!-- View Hotel -->
     <div class="modal fade" id="viewBookingModal" tabindex="-1" role="dialog" aria-labelledby="viewBookingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="viewModalLabel">Booking ID - <span id="booking_id"></span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <table class="form-group table">
                        <tr>
                            <td>Transaction No</td>
                            <td><span id="txn_no"></span></td>
                        </tr>
                        <tr>
                            <td>User Name</td>
                            <td><span id="user_name"></span></td>
                        </tr>
                        <tr>
                            <td>Check-In</td>
                            <td><span id="check_in"></span></td>
                        </tr>
                        <tr>
                            <td>Check-Out</td>
                            <td><span id="check_out"></span></td>
                        </tr>
                        <tr>
                            <td>Rooms</td>
                            <td><span id="rooms"></span></td>
                        </tr>
                        <tr>
                            <td>Adults</td>
                            <td><span id="adults"></span></td>
                        </tr>
                        <tr>
                            <td>Amount</td>
                            <td><span id="amount"></span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        </div>
      </div>

@endsection

@push('bookinglist.blade-scripts')
<script>
    $(function () {
        $('#table_booking').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": true,
            "responsive": true,
            "processing" : true,
            "serverSide" : true,
            ajax: "{{ route('get-bookings') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'hotel.name', name: 'hotel.name'},
                {data: 'user.name', name: 'user.name'},
                {data: 'check_in', name: 'check_in'},
                {data: 'check_out',name: 'check_out'},
                {data: 'total',name: 'total'},
                {data: 'action',name: 'action'},
            ]
        });
    });

    function bookingDetails(booking_id){
        $.ajax({
            url: "{{ route('booking-details') }}",
            type: 'get',
            data: { id: booking_id },
            dataType: 'json',
            success: function(res){
                if(res.status == 1){
                    for(var i=0; i<res.data.length; i++){
                        $('#viewBookingModal').modal();
                        $('#booking_id').html(booking_id);
                        $('#txn_no').html(res.data[i].response);
                        $('#user_name').html(res.data[i].name);
                        $('#check_in').html(res.data[i].check_in);
                        $('#check_out').html(res.data[i].check_out);
                        $('#rooms').html(res.data[i].rooms);
                        $('#adults').html(res.data[i].adult);
                        $('#amount').html(res.data[i].total);
                    }
                }
            }
        });
    }
</script>

@endpush

