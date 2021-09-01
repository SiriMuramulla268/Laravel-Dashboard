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
                    <!-- <th>Action</th> -->
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
@endsection

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
            <form action="{{route('add-amenity')}}" method="POST" id="addamenity" autocomplete="off"> 
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="mobile">Amenity</label><span class="text-danger">*</span>
                        <Input type="text" class="form-control" id="amenity" name="amenity" placeholder="Enter Amenity Name">
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
    <!-- <a href="" type="button" class="btn btn-danger" data-toggle="modal" onclick="deleteAmenity();"><i class="fas fa-trash-alt"></i></a> -->
@push('roomdetails.blade-scripts')
<script>
    $(function () {
        

        $("#addamenity").on("submit", function(e){
            $.ajax({
            url: "{!! route('add-amenity') !!}",
            type: 'post',
            data: $('#addamenity').serialize(),
            dataType: 'json',
            success: function(res) {
               
            }
            });
        });

        getAmenities();
    });

    function addAmenityModal(){
        $('#amenityModalLabel').html('Add Amenity');
        $("#addAmenityModal").modal();
    }

    function deleteAmenity(amenity_id){
        swal({
            text: "Are you sure you want to delete?",
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
                        if(res.status == 'deleted'){
                            toastr.success('Amenity Deleted Successfully.', 'Success', {timeOut: 1000});
                            setTimeout(function(){ 
                                window.location.reload(); 
                            }, 2000);
                        }else{
                            toastr.success('Amenity Deleted Successfully.', 'Success', {timeOut: 1000});
                        }
                	} 
                });
            }
        });
        
    }

    function getAmenities(){
        var table = $("#table_amenity");
        $.ajax({
        url: "{!! route('get-amenity') !!}",
        type: 'post',
        data: $('#addamenity').serialize(),
        dataType: 'json',
        success: function(res) {
            $.each(res, function (i, val) {
                table.append("<tr><td>"+val[0].name+"</td>");
            });
            $('#').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
            });
        }
        });
    }
</script>
@endpush
    