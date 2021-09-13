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
                    <div class="col-sm-10"><h3>Room Details</h3></div>
                    <div class="col-sm-2 text-right"><a href="" class="btn btn-primary" data-toggle="modal"
                        onclick="addRoomModal()"> Add Rooms</a></div>
                </div>
                    <br>
                <table id="table_room" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Hotel Name</th>
                    <th>Room Name</th>
                    <th>Price</th>
                    <th>Adult Price</th>
                    <th>Child Price</th>
                  <th>Amenities</th>
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
    <!-- Add Hotel -->
    <div class="modal fade" id="addRoomModal" tabindex="-1" role="dialog" aria-labelledby="addRoomModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="roomModalLabel">Add Room</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form id="addroom" method="POST" id="addroom" autocomplete="off">
                @csrf
                <div class="card-body">
                <div class="form-group">
                    <label for="hotel">Hotel</label><span class="text-danger">*</span>
                    <select class="form-control" id="hotel" name="hotel" required disabled>
                        <option value="">Select Hotel</option>
                        @foreach($hotels as $hotel)
                            <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="room_type">Room Type</label><span class="text-danger">*</span>
                        <Input type="text" class="form-control" id="room_type" name="room_type"
                            placeholder="Enter Room Type" required maxlength="50">
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="room_price">Price</label><span class="text-danger">*</span>
                        <input type="number" class="form-control" id="room_price" name="room_price"
                            placeholder="Enter Room Price" required>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="adult_price">Adult Price</label><span class="text-danger">*</span>
                            <input type="number" class="form-control" id="adult_price" name="adult_price"
                                placeholder="Enter Adult Price" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="child_price">Child Price</label><span class="text-danger">*</span>
                            <input type="number" class="form-control" id="child_price" name="child_price"
                                placeholder="Enter Child Price" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="amenities">Amenities</label>
                    <select class="selectpicker" multiple data-live-search="true" name="amenities[]" required>
                        @foreach($amenities as $amenity)
                            <option value="{{ $amenity->id }}">{{ $amenity->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="container_check col-md-5">Status
                        <input type="checkbox" id="status" name="status">
                    </label>
                </div>
                </div>
                <input type="hidden" id="id" name="id" value="">
                <!-- /.card-body -->
                <div class="card-footer">
                <button id="submit"  class="btn-primary btn-submit" >Submit </button>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
    
@endsection


@push('roomdetails.blade-scripts')
<script>
    $(function () {
        $("#addroom").validate({
            rules: {
                name: "required",
                room_type: "required",
                price: "required",
                adult_price: "required",
                child_price: "required",
            },
            messages: {
                name: "Select Hotel",
                room_type: "Type is required",
                price: "Type is required",
                adult_price: "Type is required",
                child_price: "required",
            }
        });

        $('#table_room').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
            "processing" : true,
            "serverSide" : true,
            ajax: "{{ route('get-room') }}",
            columns: [
                {data: 'hotels.name', name: 'hotels.name'},
                {data: 'type', name: 'type'},
                {data: 'price', name: 'price'},
                {data: 'per_adult_price', name: 'per_adult_price'},
                {data: 'per_child_price', name: 'per_child_price'},
                {data: 'amenities', name: 'amenities'},
                {data: 'action', name: 'action'},
            ]
        });

        $("#submit").click(function(e){
            e.preventDefault();
            $.ajax({
                url: "{!! route('add-room') !!}",
                type: 'POST',
                data: $('#addroom').serialize(),
                dataType: 'json',
                success: function(res) {
                    if(res.status == 1){
                        $("#addRoomModal").modal('hide');
                        document.getElementById("addroom").reset();
                        toastr.success( '', res.message, {timeOut: 1000});
                        $('#table_room').DataTable().ajax.reload();
                    }
                    if(res.status == 0){
                        toastr.error( '', 'Fail', {timeOut: 1000});
                    }
                    else{
                        for(var i=0;i<res.length;i++){
                            toastr.error( '', res[i], {timeOut: 1000});
                        }
                    }
                }
            });
        });
    });

    function addRoomModal(){
        $('#roomModalLabel').html('Add Room');
        document.getElementById("addroom").reset();
        $( 'input[type="checkbox"]' ).prop('checked', false);
        $("#addRoomModal").modal();
    }

    function editRoom(room_id){
        var values = [];
        $('#id').val(room_id);
        $('#roomModalLabel').html('Edit Room');
        $("#addRoomModal").modal();
        // $('#hotel').prop('disabled', true);
        document.getElementById("addroom").reset();
        $.ajax({
            url: "{{ route('view-room') }}",
            type: 'get',
            data: { id: room_id },
            dataType: 'json',
            success: function(res){
                $('#hotel').val(res.hotel);
                $('#room_type').val(res.data.type);
                $('#room_price').val(res.data.price);
                $('#adult_price').val(res.data.per_adult_price);
                $('#child_price').val(res.data.per_child_price);
                if(res.data.status == 1){
                    $('input[name=status]').attr('checked', true);
                }
                for(var i=0;i<res.amenities.length;i++){
                   values.push(res.amenities[i].id)
                }
                $('.selectpicker').selectpicker('val', values);
            }
        });
    }
</script>
@endpush
