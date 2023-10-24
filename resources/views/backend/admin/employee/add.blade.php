@extends('backend.layouts.app')
@section('content')
<main class="mt-5 pt-3">
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2>Add New Employee</h2>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <form action="{{ url('admin/employee/add') }}" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group mb-2">
                    <label>FUll Name</label>
                    <input type="text" class="form-control" name="full_name" value="{{ old('full_name') }}" placeholder="Full Name">
                    <span class="text-danger">{{ $errors->has('full_name') ? $errors->first('full_name') : "" }}</span>
                  </div>
                  <div class="form-group mb-2">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                    <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password">
                    <span class="text-danger">{{ $errors->has('password') ? $errors->first('password') : "" }}</span>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </section>
  </div>
</main>
@endsection