@extends('backend.layouts.app')
@section('content')
<main class="mt-5 pt-3">
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2>Edit Employee</h2>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <form action="{{ url('employee/profile/edit') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group mb-2">
                    <label>FUll Name</label>
                    <input type="text" class="form-control" name="full_name" value="{{ old('full_name', $profile->full_name) }}" placeholder="Full Name">
                    <input type="hidden" class="form-control" name="id" value="{{ $profile->employeeId }}">
                    <span class="text-danger">{{ $errors->has('full_name') ? $errors->first('full_name') : "" }}</span>
                  </div>
                  <div class="form-group mb-2">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email', $profile->email) }}" placeholder="Email">
                    <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : "" }}</span>
                  </div>
                  <div class="form-group mb-2">
                    <label>Emergency Contact Name</label>
                    <input type="text" class="form-control" name="contact_name" value="{{ old('contact_name', $profile->contact_name) }}" placeholder="Emergency Contact Name">
                    <span class="text-danger">{{ $errors->has('contact_name') ? $errors->first('contact_name') : "" }}</span>
                  </div>
                  <div class="form-group mb-2">
                    <label>Emergency Contact Email</label>
                    <input type="email" class="form-control" name="contact_email" value="{{ old('contact_email', $profile->contact_email) }}" placeholder="EmEmergency Contact Email">
                    <span class="text-danger">{{ $errors->has('contact_email') ? $errors->first('contact_email') : "" }}</span>
                  </div>
                  <div class="form-group mb-2">
                    <label>Address</label>
                    <input type="text" class="form-control" name="address" value="{{ old('address', $profile->address) }}" placeholder="Address">
                    <span class="text-danger">{{ $errors->has('address') ? $errors->first('address') : "" }}</span>
                  </div>
                  <div class="form-group mb-2">
                    <label>Photo</label>
                    <input type="file" class="form-control" name="photo" value="{{ old('photo', $profile->photo) }}">
                    <span class="text-danger">{{ $errors->has('photo') ? $errors->first('photo') : "" }}</span>
                    @if($profile->photo)
                      <img src="{{ asset($profile->photo) }}" style="height: 70px; margin-top: 5px" alt="Employee Photo">
                    @endif
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </section>
  </div>
</main>
@endsection