@extends('layouts.master')
@section('title',config('app.name'))
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Hotels</h1>
          </div>
        </div>
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
                    <div class="col-sm-11"></div>
                    <div class="col-sm-1"><a href="" class="btn btn-primary" data-toggle="modal" data-target="#addHotelModal"><i class="fa fa-plus"></i> Add</a></div>
                </div>
                    <br>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="col-sm-1">Sl.no  </th>
                    <th class="col-sm-3">Name</th>
                    <th clas="col-sm-2">Email</th>
                    <th class="col-sm-3">Description</th>
                    <th class="col-sm-2 text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($hotels as $key=>$hotel)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $hotel['name'] }}</td>
                      <td>{{ $hotel['email'] }}</td>
                      <td>{{ $hotel['description'] }}</td>
                      <td class="text-center">
                        <a href="" type="button" class="btn btn-info" data-toggle="modal" data-target="#viewHotelModal"><i class="far fa-eye"></i></a>
                        <a href="" type="button" class="btn btn-success" data-toggle="modal" data-target="#editHotelModal"><i class="fas fa-edit"></i></a>
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
                    {{ $hotels->links() }}
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
            <form action="{{route('add-user')}}" method="POST" id="adduser" autocomplete="off"> 
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label><span class="text-danger">*</span>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
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
                                <option value="">Select City</option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type">City</label><span class="text-danger">*</span>
                            <select class="form-control" id="city" name="city" >
                                <option value="">Select Type</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="mobile">Address</label><span class="text-danger">*</span>
                    <textarea class="form-control" name="address" rows="2"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="mobile">Description</label><span class="text-danger">*</span>
                    <textarea class="form-control" name="description" rows="3"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="mobile">Website Url</label><span class="text-danger">*</span>
                    <textarea class="form-control" name="website_url" rows="1"></textarea>
                  </div>
                  <div class="form-group">
                    <label class="container_check col-md-6">Featured
                        <input type="checkbox" name="featured">
                    </label>
                    <label class="container_check col-md-5">Status
                        <input type="checkbox" name="status">
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

    <!-- View Hotel -->
    <div class="modal fade" id="viewHotelModal" tabindex="-1" role="dialog" aria-labelledby="viewHotelModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Hotel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form action="{{route('add-user')}}" method="POST" id="adduser" autocomplete="off"> 
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label><span class="text-danger">*</span>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label><span class="text-danger">*</span>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" >
                  </div>
                  <div class="form-group">
                            <label for="type">Country</label><span class="text-danger">*</span>
                            <select class="form-control" id="type" name="country" >
                                <option value="">Select Type</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type">State</label><span class="text-danger">*</span>
                            <select class="form-control" id="type" name="state" >
                                <option value="">Select Type</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type">City</label><span class="text-danger">*</span>
                            <select class="form-control" id="type" name="city" >
                                <option value="">Select Type</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="mobile">Address</label><span class="text-danger">*</span>
                    <textarea class="form-control" name="address" rows="3"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="mobile">Description</label><span class="text-danger">*</span>
                    <textarea class="form-control" name="description" rows="3"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="mobile">Website Url</label><span class="text-danger">*</span>
                    <textarea class="form-control" name="website_url" rows="1"></textarea>
                  </div>
                  <div class="form-group">
                    <label class="container_check col-md-6">Featured
                        <input type="checkbox" name="featured">
                    </label>
                    <label class="container_check col-md-5">Status
                        <input type="checkbox" name="status">
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

  </div>
  <!-- /.content-wrapper -->
@endsection

<script>
  function countryChange(){
		// var country = $('#country').val();
    // $.ajax({
		// 	url: "{{ route('state-by-country') }}",
		// 	type: 'get',
		// 	dataType: 'json',
		// 	success: function(res) {
        
		// 	}
		// 	});
    
	}
</script>