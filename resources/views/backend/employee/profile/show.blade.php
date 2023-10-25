@extends('backend.layouts.app')
@section('content')
<main class="mt-5 pt-3">
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 pb-2 pb-sm-0">
            <h2>Profile Info</h2>
          </div>
          <div class="col-sm-6 text-sm-end">
            <a href="{{ url('employee/profile/edit/'. $profile->employeeId) }}" class="btn btn-primary">Edit Profile</a>
          </div>
        </div>
      </div>
    </section>

    <hr>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <table class="table">
              <tr>
                <th>Photo</th>
                <td>
                  @if ($profile->photo)
                    <img src="{{ asset($profile->photo) }}" style="height: 220px" alt="Employee Photo">
                  @else
                    <span class="text-danger"><b>No Photo</b></span>
                  @endif
                </td>
              </tr>
              <tr>
                <th>Full Name</th>
                <td>{{ $profile->full_name }}</td>
              </tr>
              <tr>
                <th>Email</th>
                <td>{{ $profile->email }}</td>
              </tr>
              <tr>
                <th>Address</th>
                <td>
                  @if ($profile->address)
                    <span>{{ $profile->address }}</span>
                   @else
                    <span class="text-danger"><b>Empty</b></span>
                  @endif
                </td>
              </tr>
              <tr>
                <th>Emergency Contact Name</th>
                <td>
                  @if ($profile->contact_name)
                    <span>{{ $profile->contact_name }}</span>
                   @else
                    <span class="text-danger"><b>Empty</b></span>
                  @endif
                </td>
              </tr>
              <tr>
                <th>Emergency Contact Email</th>
                <td>
                  @if ($profile->contact_email)
                    <span>{{ $profile->contact_email }}</span>
                   @else
                    <span class="text-danger"><b>Empty</b></span>
                  @endif
                </td>
              </tr>
              <tr>
                <th>Status</th>
                <td>
                  @if($profile->status == 0)
                    Active
                  @else
                    Inactive
                  @endif
                </td>
              </tr>
            </table>
          </div>
        </div>
    </section>
  </div>
</main>
@endsection