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
                    <div class="col-sm-2 text-right"><a href="" class="btn btn-primary" data-toggle="modal" data-target="#addHotelModal"> Map Rooms</a></div>
                </div>
                    <br>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sl.no  </th>
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
                      @foreach($rooms as $room)
                        @php $amenity_name = ''; @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $room->hotels->name }}</td>
                            <td>{{ $room['type'] }}</td>
                            <td>{{ $room['price'] }}</td>
                            <td>{{ $room['per_adult_price'] }}</td>
                            <td>{{ $room['per_child_price'] }}</td>
                            @foreach($room->amenities as $key=>$amenity)
                                @php
                                    if($key > 0)
                                        $amenity_name = $amenity_name.',';
                                    $amenity_name = $amenity_name.$amenity->name;
                                @endphp
                            @endforeach
                            <td>{{ $amenity_name }}</td>
                            <td class="text-center">
                                <a href="" type="button" class="btn btn-success" onclick="editRoom();"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
                </br>
                <div class="row">
                  <div class="col-8">
                  </div>
                  <div class="col-4">
                    {{ $rooms->links() }}
                  </div>
                </div>
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
@endsection

    <!-- Add Hotel -->
    <div class="modal fade" id="addHotelModal" tabindex="-1" role="dialog" aria-labelledby="addHotelModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Hotel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form action="{{route('add-room')}}" method="POST" id="addroom" autocomplete="off"> 
                    @csrf
                    <div class="card-body">
                    <div class="form-group">
                        <label for="type">Hotel</label><span class="text-danger">*</span>
                        <select class="form-control" id="hotel" name="hotel">
                            <option value="">Select Hotel</option>
                            @foreach($hotels as $hotel)
                                <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="mobile">Room Type</label><span class="text-danger">*</span>
                            <Input type="text" class="form-control" id="room_type" name="room_type" placeholder="Enter Room Type">
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="mobile">Price</label><span class="text-danger">*</span>
                            <input type="text" class="form-control" id="room_price" name="room_price" placeholder="Enter Room Price">
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mobile">Adult Price</label><span class="text-danger">*</span>
                                <input type="text" class="form-control" id="adult_price" name="adult_price" placeholder="Enter Adult Price">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mobile">Child Price</label><span class="text-danger">*</span>
                                <input type="text" class="form-control" id="child_price" name="child_price" placeholder="Enter Child Price">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Amenities</label><span class="text-danger">*</span>
                        <select class="selectpicker" multiple data-live-search="true" name="amenities[]">
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
                    <!-- /.card-body -->
                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit </button>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    
<script>
    function editRoom(){
        alert('h');
    }
</script>