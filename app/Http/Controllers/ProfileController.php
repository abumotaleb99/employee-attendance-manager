<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeDetail;
use App\Models\EmployeeContact;

class ProfileController extends Controller
{
    public function show() {
        $data['header_title'] = 'Employee List';
        $id = auth('employee')->id();
        $data['profile'] = Employee::getSingleEmployeeById($id);

        return view('backend.employee.profile.show', $data);
    }

    public function edit($id) {
        $data['profile'] = Employee::getSingleEmployeeById($id);

        if(!empty($data['profile'])) {
            $data['header_title'] = 'Edit Profile';
            
            return view('backend.employee.profile.edit', $data);
        }else {
            abort(404);
        }
    }

    public function update(Request $request) {
        $this->validate($request, [
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'contact_name' => 'required',
            'contact_email' => 'required|email',
            'address' => 'required',
        ]);
    
        $image = $request->file('photo');
    
        $employee = Employee::find($request->id);
        $employeeDetail = EmployeeDetail::where('employee_id', $request->id)->first();
        $employeeContact = EmployeeContact::where('employee_id', $request->id)->first();
        if (empty($employeeDetail)) {
            // Create a new EmployeeDetail record
            $employeeDetail = new EmployeeDetail();
            $employeeDetail->employee_id = $request->id;
        }
    
        if (empty($employeeContact)) {
            // Create a new EmployeeContact record
            $employeeContact = new EmployeeContact();
            $employeeContact->employee_id = $request->id;
        }
       
    
        if ($image) {
            if($employee->photo) {
                unlink($employee->photo);
            }
    
            $image = $request->file('photo');
            $imageName = $image->getClientOriginalName();
            $timestamp = now()->timestamp;
            $directory = 'backend/employee-photos';
            $imageUrl = $directory . '/' . $timestamp . '_' . $imageName;
            $image->move($directory, $timestamp . '_' . $imageName);
    
            $employeeDetail->photo = $imageUrl;
        }

        $employee->full_name = $request->full_name;
        $employee->email = $request->email;
        $employeeDetail->address = $request->address;
        $employeeContact->contact_name = $request->contact_name;
        $employeeContact->contact_email = $request->contact_email;
    
        $employee->save();
        $employeeDetail->save();
        $employeeContact->save();
    
        return redirect('employee/profile/show')->with("success", "Profile Updated successfully.");
    } 
}
