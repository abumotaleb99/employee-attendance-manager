@extends('backend.layouts.app')
@section('content')
<main class="mt-5 pt-3">
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2>Add Employee Details</h2>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <form action="{{ url('admin/employee/add-details') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <input type="hidden" class="form-control" name="employee_id" value="{{ request('id') }}">
                  </div>
                  <div class="form-group mb-2">
                    <label>Address</label>
                    <input type="text" class="form-control" name="address" value="{{ old('address') }}" placeholder="Address">
                    <span class="text-danger">{{ $errors->has('address') ? $errors->first('address') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Photo</label>
                    <input type="file" class="form-control" name="photo" value="{{ old('photo') }}">
                    <span class="text-danger">{{ $errors->has('photo') ? $errors->first('photo') : "" }}</span>
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