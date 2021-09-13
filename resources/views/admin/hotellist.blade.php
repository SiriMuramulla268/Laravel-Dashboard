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
                    <div class="col-sm-11"><h3>Hotels</h3></div>
                    <div class="col-sm-1">
                      <a href="" class="btn btn-primary" data-toggle="modal" onclick="addHotelModal()">
                        <i class="fa fa-plus"></i> Add</a>
                    </div>
                </div>
                    <br>
                <table id="table_hotel" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th >Name</th>
                    <th >Email</th>
                    <th >Country</th>
                    <th >State</th>
                    <th >City</th>
                    <th class="col-sm-2">Action</th>
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
    <div class="modal fade" id="addHotelModal" tabindex="-1" role="dialog" aria-labelledby="addHotelModalLabel"
      aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="addModalLabel">Add Hotel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form method="POST" id="addhotel" autocomplete="off">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label><span class="text-danger">*</span>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="email">Email</label><span class="text-danger">*</span>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                            <label for="type">Country</label><span class="text-danger">*</span>
                            <select class="form-control" id="country" name="country" onchange="countryChange()">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                  <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>
                    </div>
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type">State</label><span class="text-danger">*</span>
                            <select class="form-control" id="state" name="state" onchange="stateChange()">
                                <option value="">Select State</option>
                                @foreach($states as $state)
                                  <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type">City</label><span class="text-danger">*</span>
                            <select class="form-control" id="city" name="city" >
                                <option value="">Select City</option>
                                @foreach($cities as $city)
                                  <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="mobile">Address</label><span class="text-danger">*</span>
                        <textarea class="form-control" id="address" name="address" rows="2"
                          placeholder="Enter Address"></textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="mobile">Website URL</label><span class="text-danger">*</span>
                        <textarea class="form-control" id="website_url" name="website_url" rows="2"
                          placeholder="Enter Website URL"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="mobile">Description</label><span class="text-danger">*</span>
                    <textarea class="form-control" id="description" name="description" rows="3"
                      placeholder="Enter Description"></textarea>
                  </div>
                  <div class="form-group">
                    <label class="container_check col-md-6">Featured
                        <input type="checkbox" id="featured" name="featured">
                    </label>
                    <label class="container_check col-md-5">Status
                        <input type="checkbox" id="status" name="status">
                    </label>
                </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button id="submit" class="btn-primary btn-submit">Submit </button>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>

    <!-- View Hotel -->
    <div class="modal fade" id="viewHotelModal" tabindex="-1" role="dialog" aria-labelledby="viewHotelModalLabel"
      aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="viewModalLabel">View Hotel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="name">Name</label><span class="text-danger">*</span>
                        <input type="text" class="form-control" id="view_name" disabled="disabled" >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="email">Email</label><span class="text-danger">*</span>
                        <input type="email" class="form-control" id="view_email" disabled="disabled">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="type">Country</label><span class="text-danger">*</span>
                        <select class="form-control" id="view_country" disabled="disabled">
                            <option value="">Select Country</option>
                            @foreach($countries as $country)
                              <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                  
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="type">State</label><span class="text-danger">*</span>
                            <select class="form-control" id="view_state" disabled="disabled">
                                <option value="">Select State</option>
                                @foreach($states as $state)
                                  <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="type">City</label><span class="text-danger">*</span>
                            <select class="form-control" id="view_city" disabled="disabled">
                                <option value="">Select City</option>
                                @foreach($cities as $city)
                                  <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="mobile">Address</label><span class="text-danger">*</span>
                        <textarea class="form-control" id="view_address" rows="3" disabled="disabled"></textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="mobile">Description</label><span class="text-danger">*</span>
                        <textarea class="form-control" id="view_description" rows="3" disabled="disabled"></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="mobile">Website Url</label><span class="text-danger">*</span>
                    <textarea class="form-control" id="view_website_url" rows="1" disabled="disabled"></textarea>
                  </div>
                  
                  <div class="form-group">
                    <label for="mobile">Rooms</label><span class="text-danger">*</span>
                    <textarea class="form-control" id="rooms" rows="1" disabled="disabled"></textarea>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="container_check">Featured</label><span class="text-danger">*</span>
                        <input type="checkbox" id="view_featured" name="view_featured" disabled="disabled">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="container_check">Status</label>
                        <input type="checkbox" id="view_status" name="view_status" disabled="disabled">
                      </div>
                    </div>
                  </div>

                </div>
            </form>
            </div>
        </div>
        </div>
    </div>

  </div>
  <!-- /.content-wrapper -->
@endsection

@push('hotellist.blade-scripts')
<script>
  $(function () {

    $("#addhotel").validate({
        rules: {
          name: "required",
          email: "required",
          country: "required",
          state: "required",
          city: "required",
          address: "required",
          website_url: "required",
          description: "required",
        },
        messages: {
          name: "required",
          email: "required",
          country: "required",
          state: "required",
          city: "required",
          address: "required",
          website_url: "required",
          description: "required",
        }
    });

    $('#table_hotel').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
        "processing" : true,
        "serverSide" : true,
        ajax: "{{ route('get-hotel') }}",
        columns: [
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'country.name', name: 'country.name'},
            {data: 'state.name', name: 'state.name'},
            {data: 'city.name', name: 'city.name'},
            {data: 'action', name: 'action'},
        ]
    });

    $("#submit").click(function(e){
        e.preventDefault();
        $.ajax({
            url: "{!! route('add-hotel') !!}",
            type: 'POST',
            data: $('#addhotel').serialize(),
            dataType: 'json',
            success: function(res) {
                if(res.status == 1){
                  $("#addHotelModal").modal('hide');
                  document.getElementById("addhotel").reset();
                  toastr.success( '', res.message, {timeOut: 1000});
                  $('#table_hotel').DataTable().ajax.reload();
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

  function countryChange(){
    var country_id = $('#country').val();
    $.ajax({
      url: "{{ route('state-by-country') }}",
      type: 'get',
      data: { id: country_id },
      dataType: 'json',
      success: function(res){
        $("#state").empty();
        if(res.length > 0){
          $("#state").append("<option value=''>Select State</option>");
          for( var i = 0; i<res.length; i++){
            $("#state").append("<option value='"+res[i]['id']+"'>"+res[i]['name']+"</option>");
          }
        }else{
          $("#state").append("<option value=''>No State</option>");
        }
      }
    });
  }

  function stateChange(){
    var state_id = $('#state').val();
    $.ajax({
      url: "{{ route('city-by-state') }}",
      type: 'get',
      data: { id: state_id },
      dataType: 'json',
      success: function(res){
        $("#city").empty();
        if(res.length > 0){
          $("#city").append("<option value=''>Select City</option>");
          for( var i = 0; i<res.length; i++){
            $("#city").append("<option value='"+res[i]['id']+"'>"+res[i]['name']+"</option>");
          }
        }else{
          $("#city").append("<option value=''>No City</option>");
        }
      }
    });
  }

  function viewHotel(hotel_id){
    var rooms = '';
    $("#viewHotelModal").modal();
    $.ajax({
      url: "{{ route('view-hotel') }}",
      type: 'get',
      data: { id: hotel_id },
      dataType: 'json',
      success: function(res){
        $('#view_name').val(res[0].name);
        $('#view_email').val(res[0].email);
        $('#view_country').val(res[0].country_id);
        $('#view_state').val(res[0].state_id);
        $('#view_city').val(res[0].city_id);
        $('#view_address').val(res[0].address);
        $('#view_description').val(res[0].description);
        $('#view_website_url').val(res[0].website_url);
        for (var i=0; i<res[0].rooms.length; i++) {
          if (i > 0) {
            rooms = rooms + ',  ' + res[0].rooms[i].type;
          }else {
            rooms = rooms + res[0].rooms[i].type;
          }
        }
        $('#rooms').val(rooms);
        if(res[0].featured == 1){
          $('input[name=view_featured]').attr('checked', true);
        }
        if(res[0].status == 1){
          $('input[name=view_status]').attr('checked', true);
        }
      }
    });
  }

  function editHotel(hotel_id){
    $("#addHotelModal").modal();
    $('#addModalLabel').html('Edit Hotel');
    document.getElementById("addhotel").reset();
    $.ajax({
      url: "{{ route('view-hotel') }}",
      type: 'get',
      data: { id: hotel_id },
      dataType: 'json',
      success: function(res){
        $('#name').val(res[0].name);
        $('#email').val(res[0].email);
        $('#country').val(res[0].country_id);
        countryChange();

        setTimeout(function(){
          $('#state').val(res[0].state_id);
          stateChange();
        }, 500);

        setTimeout(function(){
          $('#city').val(res[0].city_id);
        }, 600);
        $('#address').val(res[0].address);
        $('#description').val(res[0].description);
        $('#website_url').val(res[0].website_url);
        if(res[0].featured == 1){
          $('input[name=featured]').attr('checked', true);
        }
        if(res[0].status == 1){
          $('input[name=status]').attr('checked', true);
        }
      }
    });
  }

  function addHotelModal(){
    $('#addModalLabel').html('Add Hotel');
    document.getElementById("addhotel").reset();
    $( 'input[type="checkbox"]' ).prop('checked', false);
    $("#addHotelModal").modal();
  }

</script>
@endpush
