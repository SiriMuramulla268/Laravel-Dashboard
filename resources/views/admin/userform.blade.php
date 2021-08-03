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
            <h1>User Form</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
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
                    <label for="password">Password</label><span class="text-danger">*</span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                  </div>
                  <div class="form-group">
                    <label for="company">Company</label><span class="text-danger">*</span>
                    <input type="text" class="form-control" id="company" name="company" placeholder="Enter company">
                  </div>
                  <div class="form-group">
                    <label for="mobile">Mobile</label><span class="text-danger">*</span>
                    <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Enter mobile">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit </button>
                  @if(session('status'))
                    <span class="text-success"> {{ session('status') ?? ''  }}</span>
                  @endif

                  
                </div>
                
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
          <!-- right column -->
         
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  @section('footer')
        @parent
  @endsection

@endsection