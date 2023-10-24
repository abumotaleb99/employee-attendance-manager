@extends('backend.layouts.app')
@section('content')
<main class="mt-5 pt-3">
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2>Add Employee Contact Info</h2>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <form action="{{ url('admin/employee/add-contact') }}" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <input type="hidden" class="form-control" name="employee_id" value="{{ request('id') }}">
                  </div>
                  <div class="form-group mb-2">
                    <label>Emergency Contact Name</label>
                    <input type="text" class="form-control" name="contact_name" value="{{ old('contact_name') }}" placeholder="Emergency Contact Name">
                    <span class="text-danger">{{ $errors->has('contact_name') ? $errors->first('contact_name') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Emergency Contact Email</label>
                    <input type="email" class="form-control" name="contact_email" value="{{ old('contact_email') }}" placeholder="EmEmergency Contact Email">
                    <span class="text-danger">{{ $errors->has('contact_email') ? $errors->first('contact_email') : "" }}</span>
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