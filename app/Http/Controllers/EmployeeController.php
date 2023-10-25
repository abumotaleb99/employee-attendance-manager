<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeDetail;
use App\Models\EmployeeContact;
use Hash;

class EmployeeController extends Controller
{
    public function employeeList() {
        $data['header_title'] = 'Employee List';
        $data['allEmployees'] = Employee::getAllEmployees();

        return view('backend.admin.employee.list', $data);
    }

    public function add() {
        $data['header_title'] = 'Add New Employee';

        return view('backend.admin.employee.add', $data);
    }

    public function insert(Request $request) {
        $this->validate($request, [
            'full_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:20',
        ]);

        $employee = new Employee;
        
        $employee->full_name = $request->full_name;
        $employee->email = $request->email;
        $employee->password = Hash::make($request->password);
        $employee->save();

        return redirect('admin/employee/list')->with("success", "Employee added successfully.");
    }

    public function showAddDetailsForm() {
        $data['header_title'] = 'Add Employee Details';

        return view('backend.admin.employee.employee-details', $data);
    }

    public function addDetails(Request $request) {
        $this->validate($request, [
            'address' => 'required',
            'photo' => 'required',
        ]);

        $image = $request->file('photo');
        $imageName = $image->getClientOriginalName();
        $timestamp = now()->timestamp; // Get the current 
        $directory = 'backend/employee-photos/';
        $imageUrl = $directory . $timestamp . '_' . $imageName; // Add timestamp to the filename
        $image->move($directory, $timestamp . '_' . $imageName);

        $employeeDetail = new EmployeeDetail();
        $employeeDetail->employee_id = $request->employee_id;
        $employeeDetail->address = $request->address;
        $employeeDetail->photo = $imageUrl;
        $employeeDetail->save();

        return redirect('admin/employee/list')->with("success", "Employee Details added successfully.");
    }

    public function showAddContactForm() {
        $data['header_title'] = 'Add Employee Contact';

        return view('backend.admin.employee.employee-contact', $data);
    }

    public function addContact(Request $request) {
        $this->validate($request, [
            'contact_name' => 'required',
            'contact_email' => 'required',
        ]);

        $employeeContact = new EmployeeContact();
        $employeeContact->employee_id = $request->employee_id;
        $employeeContact->contact_name = $request->contact_name;
        $employeeContact->contact_email = $request->contact_email;
        $employeeContact->save();

        return redirect('admin/employee/list')->with("success", "Employee Contact Info added successfully.");
    }

        
    public function edit($id) {
        $data['employee'] = Employee::getSingleEmployeeById($id);

        if(!empty($data['employee'])) {
            $data['header_title'] = 'Edit Employee';

            return view('backend.admin.employee.edit', $data);
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
    
        return redirect('admin/employee/list')->with("success", "Employee Updated successfully.");
    }    

    public function delete($id) {
        $employee = Employee::find($id);

        if ($employee) {
            $employeeDetail = EmployeeDetail::where('employee_id', $id)->first();
            if ($employeeDetail) {
                $employeeDetail->delete();
            }

            $employeeContact = EmployeeContact::where('employee_id', $id)->first();
            if ($employeeContact) {
                $employeeContact->delete();
            }

            $employee->delete();

            return redirect('admin/employee/list')->with("success", "Employee deleted successfully.");
        } else {
            abort(404);
        }
    }


}

