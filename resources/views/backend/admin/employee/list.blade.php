@extends('backend.layouts.app')
@section('content')
<main class="mt-5 pt-3">
  <div class="content-fluid">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 pb-2 pb-sm-0">
            <h2>Employee List</h2>
          </div>
          <div class="col-sm-6 text-sm-end">
            <a href="{{ url('admin/employee/add') }}" class="btn btn-primary">Add New Employee</a>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="fw-bold fs-4">Search Employee</h3>
             </div>
            <form action="" method="get">
                @csrf
                <div class="card-body row">
                  <div class="form-group col-12 col-md-3">
                    <label>Full Name</label>
                    <input type="text" class="form-control" name="full_name" value="{{ Request::get('full_name') }}" placeholder="Full Name">
                  </div>
                  <div class="form-group col-12 col-md-3">
                    <label>Contact Name</label>
                    <input type="text" class="form-control" name="contact_name" value="{{ Request::get('contact_name') }}" placeholder="Contact Name">
                  </div>
                  <div class="form-group  col-12 col-md-3 float-left">
                    <label>Status</label>
                    <select class="form-control" name="status" >
                      <option value="0">Active</option>
                      <option value="1">Inactive</option>
                    </select>
                  </div>
                  <div class="form-group form-group col-12 col-md-3 mb-0 d-md-flex align-items-center pt-md-3">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ url('admin/employee/list') }}" class="btn btn-success ms-1">Clear</a>
                  </div>
                </div>
              </form>
            </div>

            @include('backend.message')
            <div class="card">
              <div class="card-header">
                <h3 class="fw-bold fs-4">Employee List</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Photo</th>
                      <th>Email</th>
                      <th>Emergency Contact</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($allEmployees) > 0)
                  
                    @php($i = 1)
                    @foreach($allEmployees as $employee)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $employee->full_name }}</td>
                      <td>
                        @if ($employee->photo)
                            <img src="{{ asset($employee->photo) }}" style="height: 70px" alt="Employee Photo">
                        @else
                          <span class="text-danger"><b>No Photo</b></span>
                        @endif
                      </td>
                      <td>{{ $employee->email }}</td>
                      <td>
                        @if ($employee->contact_name || $employee->contact_email)
                            <span><b>Name:</b> {{ $employee->contact_name }}</span> <br>
                            <span><b>Email:</b> {{ $employee->contact_email }}</span>
                        @else
                            <span class="text-danger"><b>No Emergency Contact</b></span>
                        @endif
                      </td>
                      <td>
                        @if($employee->status == 0)
                          Active
                        @else
                          Inactive
                        @endif
                      </td>
                      <td>
                        <a href="{{ url('admin/employee/add-details/'. $employee->employeeId) }}" class="btn btn-primary">Add Details</a>
                        <a href="{{ url('admin/employee/add-contact/'. $employee->employeeId) }}" class="btn btn-primary">Add Contact</a>
                        <a href="{{ url('admin/employee/edit/'. $employee->employeeId) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ url('admin/employee/delete/'. $employee->employeeId) }}" class="btn btn-danger">Delete</a>
                      </td>
                    </tr>
                    @endforeach

                  @else
                    <tr>
                      <td colspan="6" class="text-center">No data found.</td>
                    </tr>
                  @endif
                  </tbody>
                </table>
                <div class="d-flex justify-content-center pt-2">
                  {{ $allEmployees->onEachSide(1)->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</main>
@endsection