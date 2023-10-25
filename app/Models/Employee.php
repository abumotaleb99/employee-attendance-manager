<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Request;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    // static public function getAllEmployees() {
    //     $query = Employee::select('employees.*', 'employees.id', 'employee_details.*', 'employee_contacts.*')
    //         ->leftJoin('employee_details', 'employee_details.employee_id', '=', 'employees.id')
    //         ->leftJoin('employee_contacts', 'employee_contacts.employee_id', '=', 'employees.id');
        
    //     if(!empty(Request::get('full_name'))) {
    //         $result = $query->where('employees.full_name', 'like', '%'. Request::get('full_name'). '%');
    //     }

    //     if(!empty(Request::get('contact_name'))) {
    //         $result = $query->where('employee_contacts.contact_name', 'like', '%'. Request::get('contact_name'). '%');
    //     }

    //     if(!empty(Request::get('status'))) {
    //         $result = $query->where('employees.status', 'like', '%'. Request::get('status'). '%');
    //     }
        
    //     $result = $query->orderBy('employees.id', 'desc')
    //         ->paginate(10);
        
    //     return $result;
    // }

    static public function getAllEmployees() {
        $query = Employee::select('employees.id as employeeId', 'employees.full_name', 'employees.email', 'employees.status', 'employee_details.*', 'employee_contacts.*')
            ->leftJoin('employee_details', 'employee_details.employee_id', '=', 'employees.id')
            ->leftJoin('employee_contacts', 'employee_contacts.employee_id', '=', 'employees.id');
        
        if(!empty(Request::get('full_name'))) {
            $query->where('employees.full_name', 'like', '%'. Request::get('full_name'). '%');
        }
    
        if(!empty(Request::get('contact_name'))) {
            $query->where('employee_contacts.contact_name', 'like', '%'. Request::get('contact_name'). '%');
        }
    
        if(!empty(Request::get('status'))) {
            $query->where('employees.status', 'like', '%'. Request::get('status'). '%');
        }
        
        $result = $query->orderBy('employees.id', 'desc')
            ->paginate(10);
        
        return $result;
    }

    static public function getSingleEmployeeById($id) {
        $query = Employee::select('employees.id as employeeId', 'employees.full_name', 'employees.email', 'employees.status', 'employees.password', 'employee_details.*', 'employee_contacts.*')
            ->leftJoin('employee_details', 'employee_details.employee_id', '=', 'employees.id')
            ->leftJoin('employee_contacts', 'employee_contacts.employee_id', '=', 'employees.id')
            ->where('employees.id', $id)
            ->first();
    
        return $query;
    }
    
    
}
