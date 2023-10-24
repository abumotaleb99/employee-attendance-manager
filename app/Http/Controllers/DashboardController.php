<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function dashboard() {
        $data['header_title'] = 'Dashboard';
        
        if(Auth::check()) {
            return view('backend.admin.dashboard', $data);

        }elseif(Auth::guard('employee')->check()) {
            return view('backend.employee.dashboard', $data);

        }
    }


}
