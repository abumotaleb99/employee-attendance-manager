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
}
