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
                    <div class="col-sm-10"><h3>Amenities</h3></div>
                    <div class="col-sm-2 text-right"><a href="" class="btn btn-primary" data-toggle="modal" onclick="addAmenityModal()"> Add</a></div>
                </div>
                    <br>
                <table id="table_amenity" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Amenity</th>
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
     <div class="modal fade" id="addAmenityModal" tabindex="-1" role="dialog" aria-labelledby="addAmenityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="amenityModalLabel">Add Amenity</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form id="addamenity" method="POST" autocomplete="off"> 
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="amenity">Amenity</label><span class="text-danger">*</span>
                        <Input type="text" class="form-control" id="amenity" name="amenity" placeholder="Enter Amenity Name">
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                <button class="btn-primary btn-submit">Submit </button>
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
        $('#table_amenity').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
            "processing" : true,
            "serverSide" : true,
            ajax: "{{ route('get-amenity') }}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'action', name: 'action'},
            ]
        });
     
        $(".btn-submit").click(function(e){
            e.preventDefault();
            $.ajax({
                url: "{!! route('add-amenity') !!}",
                type: 'POST',
                data: $('#addamenity').serialize(),
                dataType: 'json',
                success: function(res) {
                    if(res.status == 1){
                        $("#addAmenityModal").modal();
                        document.getElementById("addamenity").reset();
                        toastr.success( '', res.message, {timeOut: 1000});
                        $('#table_amenity').DataTable().ajax.reload();
                    }else{
                        toastr.error( '', res.message, {timeOut: 1000});
                    }
                }
            });
        });
    });

    function addAmenityModal(){
        $('#amenityModalLabel').html('Add Amenity');
        $("#addAmenityModal").modal();
    }

    function deleteAmenity(amenity_id){
        swal({
            text: "Are you sure you want to delete ?",
            buttons: ['NO', 'YES'],
            dangerMode: true
        })
        .then(function(value) {
            if(value == true){
                $.ajax({
                	url: "{{ route('delete-amenity') }}",
                	type: 'get',
                    data: { id: amenity_id },
                	dataType: 'json',
                	success: function(res){
                        if(res.status == 1){
                            toastr.success('', res.message, {timeOut: 1000});
                            $('#table_amenity').DataTable().ajax.reload();
                        }else{
                            toastr.error('',res.message, {timeOut: 1000});
                        }
                	} 
                });
            }
        });
    }

</script>
@endpush
    