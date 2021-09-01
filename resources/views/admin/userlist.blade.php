@extends('layouts.master')
@section('title',config('app.name'))
@section('content')
  @section('sidebar')
      @parent
  @endsection

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li> -->
            </ol>
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
                <table id="table_user" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id  </th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($memberdata as $mem)
                    <tr>
                    <td>{{$mem['id']}}  </td>
                    <td>{{$mem['name']}}</td>
                    <td>{{$mem['email']}}</td>
                    <td>{{$mem['mobile']}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                </br>
                <div class="row">
                  <div class="col-8">
                  </div>
                  <div class="col-4">
                    <!-- <span >{{$memberdata->links()}}</span> -->
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
  </div>
  <!-- /.content-wrapper -->

@endsection

@push('userlist.blade-scripts')
<script>
  $(function () {
      $('#table_user').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true,
          "responsive": true,
      });
  });
</script>
@endpush